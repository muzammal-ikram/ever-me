<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use App\Http\Utilties\CommonUtils;
use App\Http\Utilties\RulesUtils;
use App\Platform;
use App\Property;
use App\PropertyMedia;
use App\PropertyResource;
use App\PropertySection;
use App\SectionInformation;
use App\User;

class BaseUtility {

    function __construct() {
        
    }

    /**
     * 
     * SETTERS
     */
    public function getCommonUtils() {
        return new CommonUtils();
    }
    
    public function getRulesUtils() {
        return new RulesUtils();
    }

    public function platformModal() {
        return new Platform();
    }

    public function propertyModal() {
        return new Property();
    }

    public function userModal() {
        return new User();
    }

    public function propertyResourceModal() {
        return new PropertyResource();
    }

    public function propertySectionModal() {
        return new PropertySection();
    }

    public function sectionInfoModal() {
        return new SectionInformation();
    }

    public function PropertyMediaModal() {
        return new PropertyMedia();
    }
   

}
