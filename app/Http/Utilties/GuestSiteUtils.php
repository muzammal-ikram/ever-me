<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use App\Property;
use App\PropertyResource;
use SKAgarwal\GoogleApi\PlacesApi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use Request;
use App\Http\Utilties\CommonUtils;
use App\User;



class GuestSiteUtils extends BaseUtility {

    public function getGuestSiteData($property_id, $uuid = ""){
        if(isset($property_id)){
            $properties = Property::whereHas('property_resources', function($query) use ($property_id,  $uuid) {
                $query->where(function ($query) use ($uuid, $property_id){
                    if($uuid != ""){
                        $query->where('uuid', $uuid);
                    }
                    $query->where('property_id', $property_id);
                });
            })->with(['property_resources' => function($query){
                $query->with('property_property_media');
                $query->with(['property_property_sections' => function($query){
                    $query->orderBy('order','ASC');
                    $query->with('property_section_information');
                }]);
            }])->first();
 
            if(isset($properties)){
                $user = $this->userModal()->getUserById($properties['user_id']);
                return view('guest_site.index', compact('properties', 'user'));
            } else {
                return abort(403, 'Unauthorized action.');
            }
        }
    }

    public function getNearby($property_resource_id, $type){

        if($type == "restaurant"){
            if(Session::get('nearby_url')){
                Session::put('nearby_url', '');
            }
            $this->getCommonUtils()->referalUrls("nearby_url");
        }

        if(isset($property_resource_id)){
            $googlePlaces = new PlacesApi(config('paths.google_api'));
            $property_resources = $this->propertyResourceModal()->getResourceByIdWithProperty($property_resource_id);
            $location = $property_resources['property']['lat_long'];
            if(!preg_match('([0-9])', $location) ) 
            { 
                return redirect()->back()->with('error', 'Location not found');
            } 
            $response = $googlePlaces->nearbySearch($location, $radius = 500, $params = ['rankby' => 'distance', 'type' => $type]);
            $nearby_results = $response->toArray();

            foreach($nearby_results['results'] as $places){
                if(isset($places['photos'])){
                $photo_reference = $places['photos'][0]['photo_reference'];
                $id = $places['id'];
                $max_width = $places['photos'][0]['width'];
                $max_height = $places['photos'][0]['height'];
                
                $nearby_photos[$id] = $googlePlaces->photo($photo_reference, $params = ['maxwidth' => $max_width, 'maxheight' => $max_height]);
                }
            }
            return view('guest_site.nearby', compact('nearby_results', 'nearby_photos', 'property_resource_id'));
        }
    }

    public function propertyPreferencePassword($id){

        $property = $this->propertyModal()->getPropertyById($id);

        if($property['preference'] == 1){
            return view('guest_site.property_password', compact('property'));
        } else {
            return abort(403, 'Unauthorized action.');
        }

    }

    public function restrictedPropertyLogin(){

        $request_params = Request::all();
        $uuid = "";
        $property = $this->propertyModal()->getPropertyById($request_params['property_id']);
        if (Hash::check($request_params['password'], $property['password'])){
            $property_id = $request_params['property_id'];
                $properties = Property::whereHas('property_resources', function($query) use ($property_id,  $uuid) {
                    $query->where(function ($query) use ($uuid, $property_id){
                        if($uuid != ""){
                            $query->where('uuid', $uuid);
                        }
                        $query->where('property_id', $property_id);
                    });
                })->with(['property_resources' => function($query){
                    $query->with('property_property_media');
                    $query->with(['property_property_sections' => function($query){
                        $query->with('property_section_information');
                    }]);
                }])->first();

                if(isset($properties)){
                    $user = $this->userModal()->getUserById($properties['user_id']);
                    return view('guest_site.index', compact('properties', 'user'));
                } else {
                    return abort(403, 'Unauthorized action.');
                }      
        } else {
            return redirect()->back()->with('error', 'Password not matched');
        }
    }

    public function contactUs(){
        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->contact_us_rules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors()->first());
        }
        return $this->continueContactUs($request_params);

    }

    public function continueContactUs($request_params){

        $user = $this->userModal()->getUserById($request_params['user_id']);
        if($user){
            $message_data['email'] = $user->email;
            $message_data['property_owner_name'] = $user->name;
        }

        $message_data['subject'] = 'Guset Contact:'. ' ' .$request_params['email'];
        $message_data['user_email'] = $request_params['email'];
        $message_data['name'] = $request_params['name'];
        $message_data['platform'] = $request_params['platform'];
        $message_data['cell_no'] = $request_params['cell_no'];
        $message_data['message'] = $request_params['message'];
        $message_data['property_name'] = $request_params['property_name'];
        $message_data['property_address'] = $request_params['property_address'];
        $message_data['property_city'] = $request_params['property_city'];

        $send_email = $this->getCommonUtils()->sendEmail('guest_site.emails.contact_us_email', $message_data);

        if($send_email){
            return redirect()->back()->with('success', 'Email sent');
        }    
    }


}
