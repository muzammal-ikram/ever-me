<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use Illuminate\Support\Facades\Validator;


class PropertyResourceUtils extends BaseUtility {
    
    public function getResources($property_id){
        $resources = $this->propertyModal()->getPropertyWithResources($property_id);
        return view('property_resources.index', compact('resources'));
    }

}
