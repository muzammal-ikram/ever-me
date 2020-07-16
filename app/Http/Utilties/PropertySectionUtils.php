<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use Illuminate\Support\Facades\Validator;
use Request;
use App\PropertySection;
use App\SectionInformation;
use Auth;


class PropertySectionUtils extends BaseUtility {

    public function getSections($property_id, $property_resource_id){
        $property = $this->propertyModal()->getPropertyById($property_id);
        $property_resource = $this->propertyResourceModal()->getPropertyResourceById($property_resource_id);
        $sections = $this->propertySectionModal()->getSectionWithInformation($property_id, $property_resource_id);
        return view('property_sections.index',compact('property_id' , 'property_resource_id','sections', 'property_resource', 'property'));
    }

    public function createSectionView(){
        return view('property_sections.create', compact('property_id' , 'property_resource_id'));
    }

    public function storeSection($property_id , $property_resource_id){
        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->property_section_rules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors()->first());
        }

        $property_section = new PropertySection();
        $property_section->user_id = Auth::id();
        $property_section->property_id = $property_id;
        $property_section->property_resource_id = $property_resource_id;
        $property_section->title = $request_params['section_name'];

        $property_section->save();
        return redirect()->back()->with('success' , 'Property Section Added Successfully');
    }
    
    public function editSectionView($property_section){
        return view('property_sections.edit', compact('property_section'));
    }

    public function updateSection(){
        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->property_section_update_rules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors()->first());
        }
        $property_section = $this->propertySectionModal()->getSectionById($request_params['section_id']);

        $property_section->user_id = Auth::id();
        $property_section->property_id = $request_params['property_id'];
        $property_section->property_resource_id = $request_params['property_resource_id'];
        $property_section->title = $request_params['title'];
        $property_section->save();

        return redirect()->back()->with('success' , 'Property Section updated Successfully');
    }

    public function deleteSection($section_id){
        $section_info = SectionInformation::where('property_section_id', $section_id)->delete();
        $propertySection = PropertySection::findOrFail($section_id);
        $propertySection->delete();
        return redirect()->back()->with('success', 'Property Section has been  deleted.');
    }

    public function sectionSortable($request){
        $sections = PropertySection::all();
        foreach ($sections as $section) {
            foreach ($request->order as $order) {
                if ($order['id'] == $section->id) {
                    $section->update(['order' => $order['position']]);
                }
            }
        }
    }


}
