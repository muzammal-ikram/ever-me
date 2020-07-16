<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;


class RulesUtils {

    /**
     * Login rules and their translation goes here.
     *
     * 
     */
    public $property_rules = [
        'property_name'         => 'required|max:40',
        'property_address'      => 'required',
        'property_city'         => 'required',
        'property_state'        => 'required',
        'property_zipcode'      => 'required',
        'host_name'             => 'required',
        'host_phone'            => 'required|digits_between:11,15|numeric',
    ];

    public $contact_us_rules = [
        'name' => 'required|max:30',
        'email' => 'required',
        'cell_no' => 'required|numeric',
    ];

    public $user_password_change = [
        // 'current_password' => 'required|min:8',
        'password' => 'required|min:8|confirmed',
    ];

    public $property_section_rules = [
        'section_name' => 'required|max:40',
    ];

    public $property_section_update_rules = [
        'title' => 'required|max:40',
    ];

    public $section_info_rules = [
        'title' => 'required|max:40',
    ];

    public $section_info_video_rules = [
        'video_url' => 'url'
    ];


}