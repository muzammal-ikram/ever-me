<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use Illuminate\Support\Facades\Validator;
use App\Property;
use App\PropertyResource;
use Request;
use App\Platform;
use Illuminate\Support\Facades\Auth;


class PropertyUtils extends BaseUtility {

    public function storeProperty(){
        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->property_rules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors()->first());
        }
        return $this->saveStoreProperty($request_params);
    }

    public function saveStoreProperty($request_params) {

        $new_property = new Property();
        $new_property->user_id = Auth::id();
        $new_property->property_name = $request_params['property_name'];
        $new_property->property_address = $request_params['property_address'];
        $new_property->lat_long = $request_params['lat'].','.$request_params['long'];
        $new_property->property_city = $request_params['property_city'];
        $new_property->property_state = $request_params['property_state'];
        $new_property->property_zipcode = $request_params['property_zipcode'];

        $new_property->host_name = $request_params['host_name'];
        $new_property->host_phone = $request_params['host_phone'];
        $new_property->host_other_phone = $request_params['host_other_phone'];

        return $this->savePropertyandHostPicture($request_params, $new_property);

    }

    public function savePropertyandHostPicture($request_params, $new_property) {

        if (isset($request_params['property_image'])) {
            $new_property->addMedia(storage_path('tmp/uploads/' . $request_params['property_image']))->toMediaCollection('property_image');
        } else {
            return redirect()->back()->withInput()->with('error', 'Property image is required');
        }

        if (isset($request_params['host_photo'])) {
            $new_property->addMedia(storage_path('tmp/uploads/' . $request_params['host_photo']))->toMediaCollection('host_photo');
        }
        $new_property->save();

        return $this->savePropertyPlatform($request_params, $new_property);

    }

    public function savePropertyPlatform($request_params, $new_property) {

        if(!empty($request_params->host_platform)){
            $platform = Platform::findOrFail($request_params->host_platform);
            $new_property->propertyplatforms()->attach($platform);
        }

        return $this->savePropertyBlocks($new_property);
    }

    public function savePropertyBlocks($new_property) {

        $property = Property::findOrFail($new_property->id);
        // adding default resources of a property
        $property->property_resources()->save(new PropertyResource([
            'user_id' => Auth::id(),
            'title' => 'Property Info',
        ]));
        $property->property_resources()->save(new PropertyResource([
            'user_id' => Auth::id(),
            'title' => 'Rules and Policies',
        ]));
        $property->property_resources()->save(new PropertyResource([
            'user_id' => Auth::id(),
            'title' => 'Area Guide',
        ]));
        $property->property_resources()->save(new PropertyResource([
            'user_id' => Auth::id(),
            'title' => 'Nearby',
            'nearby' => '1'
        ]));
        $property->property_resources()->save(new PropertyResource([
            'user_id' => Auth::id(),
            'title' => 'Media',
            'media' => '1'
        ]));

        return redirect('/properties')->with('success' , 'Property Added Successfully');

    }

    public function createProperty(){
        $this->javascript();
        $platform = $this->platformModal()->getAllPlatform();
        return view('properties.create', compact('platform'));
    }

    public function editProperty($property){
        $this->javascript();
        $platforms = $this->platformModal()->getAllPlatform();
        $property->load('propertyplatforms');

        foreach($property['propertyplatforms'] as $platform){
                $ids[] = $platform['id'];
        }
        return view('properties.edit', compact('platforms', 'property', 'ids', 'property_image', 'host_photo'));
    }

    public function javascript(){
        \JavaScript::put([
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => Auth::user()->phone,
            'image' =>  (asset(Auth::user()->profile_image)) ? asset(Auth::user()->profile_image) :  asset('/dist/img/avatar1.jpg'),
            'default_img' => asset('/dist/img/avatar1.jpg')
        ]);
    }

    public function updateProperty($property){
        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->property_rules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors()->first());
        }
        return $this->updatePropertyContinue($property, $request_params);
    }

    public function updatePropertyContinue($property, $request_params) {

        $property = Property::findOrFail($property->id);

        $property->user_id = Auth::id();
        $property->property_name = $request_params['property_name'];
        $property->property_address = $request_params['property_address'];
        $property->lat_long = $request_params['lat'].','.$request_params['long'];
        $property->property_city = $request_params['property_city'];
        $property->property_state = $request_params['property_state'];
        $property->property_zipcode = $request_params['property_zipcode'];

        $property->host_name = $request_params['host_name'];
        $property->host_phone = $request_params['host_phone'];
        $property->host_other_phone = $request_params['host_other_phone'];

        return $this->updatePropertyandHostPicture($property, $request_params);


    }

    public function updatePropertyandHostPicture($property, $request_params) {

        if (isset($request_params['property_image'])) {
            if (!$property->property_image || $request_params['property_image'] !== $property->property_image->file_name) {
                $property->addMedia(storage_path('tmp/uploads/' . $request_params['property_image']))->toMediaCollection('property_image');
            }
        } elseif ($property->property_image) {
            $property->property_image->delete();
        }

        if (isset($request_params['host_photo'])) {
            if (!$property->host_photo || $request_params['host_photo'] !== $property->host_photo->file_name) {
                $property->addMedia(storage_path('tmp/uploads/' . $request_params['host_photo']))->toMediaCollection('host_photo');
            }
        } elseif ($property->host_photo) {
            $property->host_photo->delete();
        }
        $property->save();

        return $this->updatePropertyPlatform($property, $request_params);
    }

    public function updatePropertyPlatform($property, $request_params) {

        if(!empty($request_params['host_platform'])){
            $property->propertyplatforms()->detach();
            $platform = Platform::findOrFail($request_params['host_platform']);
            $property->propertyplatforms()->attach($platform);
        }

        return  redirect('/properties')->with('success' , 'Property Updated Successfully');
    }

    public function deleteProperty($property){

        $property = $this->propertyModal()->getPropertyById($property->id);
        $property->delete();
        return redirect('/properties')->with('success', 'Property has been  deleted.');
    }

    public function updatePreference(){

        $request_params = Request::all();

        if($request_params['preference_selected'] == '1' && $request_params['property_password'] == Null){
            return redirect()->back()->with('error', 'Password is required for private property.');
        }

        $property = $this->propertyModal()->getPropertyById($request_params['property_id']);
                
        $property->preference = $request_params['preference_selected'];
        $property->seo_hide = $request_params['search_engine_selected'];
        $property->password = bcrypt($request_params['property_password']);

        $property->save();

        return redirect()->back()->with('success', 'Visibility has been updated.');
    }
    

    







}
