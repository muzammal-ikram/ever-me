<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use App\SectionInformation;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Request;


class SectionInfoUtils extends BaseUtility {

    public function storeInformation(){
        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->section_info_rules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors()->first());
        }
        return $this->saveStoreInformation($request_params);
    }

    public function saveStoreInformation($request_params) {

        $section_information = new SectionInformation();
        $section_information->property_section_id = $request_params['section_id'];
        $section_information->user_id = Auth::user()->id;
        $section_information->title = $request_params['title'] ? $request_params['title'] : "";
        $section_information->description = $request_params['description'] ? $request_params['description'] : "";

        return $this->savePictureOrVideo($request_params, $section_information);
    }

    public function savePictureOrVideo($request_params, $section_information) {

        if($request_params['video_url']){
            $validation = Validator::make($request_params, $this->getRulesUtils()->section_info_rules);
            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation->errors()->first());
            }
            $section_information->video_url = $request_params['video_url'];
            $section_information->save();
        }

        if (isset($request_params['image_url'])) {
            $section_information->addMedia(storage_path('tmp/uploads/' . $request_params['image_url']))->toMediaCollection('image_url');
        }
        $section_information->save();

        return redirect()->back()->with('success' , 'Property Sub section Added Successfully');
    }

    public function editInformation($id){

        $url =  $this->getCommonUtils()->referalUrls("edit_section_url");
        $information = $this->sectionInfoModal()->getInfoById($id);
        return view('property_sections.edit', compact('information'));
    }

    public function updateInformation($id){
        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->section_info_rules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors()->first());
        }
        return $this->updateStoreInformation($request_params, $id);
    }

    public function updateStoreInformation($request_params, $id) {

        $section_info = SectionInformation::findOrFail($request_params['info_id']);

        $section_info->user_id = Auth::id();
        $section_info->property_section_id = $request_params['section_id'];
        $section_info->title = ($request_params['title']) ? $request_params['title'] : 'Welcome';
        $section_info->description = $request_params['description'];


        return $this->updatePictureOrVideo($request_params, $section_info);
    }

    public function updatePictureOrVideo($request_params, $section_info) {

        if($request_params['video_url'] != null){
            $section_info->video_url = $request_params['video_url'];
        }
        $section_info->save();

        if (isset($request_params['image_url'])) {
            if (!$section_info->image_url || $request_params['image_url'] !== $section_info->image_url->file_name) {
                $section_info->addMedia(storage_path('tmp/uploads/' . $request_params['image_url']))->toMediaCollection('image_url');
            }
        } elseif ($section_info->image_url) {
            $section_info->image_url->delete();
        }

        $referral_urls = Session::get('edit_section_url');
        Session::put('edit_section_url', "");

        return Redirect::to($referral_urls)->with('success', 'Property Sub Section has been updated.');
    }

    public function deleteInformation($id) {
        $section_info = SectionInformation::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Property Sub section has been deleted.');
    }

    


}
