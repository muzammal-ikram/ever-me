<?php

namespace App\Http\Controllers\GuestSite;

use App\Property;
use App\PropertyResource;
use Illuminate\Http\Request;
use SKAgarwal\GoogleApi\PlacesApi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Http\Utilties\CommonUtils;
use App\User;

class GuestSiteController extends Controller
{
    
    public function guestSite($property_id, $uuid = "") 
    {
        try {
            return $this->getGuestSiteUtils()->getGuestSiteData($property_id, $uuid = "");
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function nearbyProperty($property_resource_id, $type) 
    {
        try {
            return $this->getGuestSiteUtils()->getNearby($property_resource_id, $type);
        } catch (ModelNotFoundException $exception) {
            return abort(404, 'Not Found');
        }
    }

    public function propertyPreferencePassword($id)
    {
        try {
            return $this->getGuestSiteUtils()->propertyPreferencePassword($id);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function restrictedPropertyLogin()
    {
        try {
            return $this->getGuestSiteUtils()->restrictedPropertyLogin();
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function contactEmail(Request $request){

        try {
            return $this->getGuestSiteUtils()->contactUs();
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

}
