<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use App\PropertyMedia;
use App\PropertyResource;
use Illuminate\Support\Facades\Auth;


class PropertyMediaUtils extends BaseUtility {

    public function storePropertyMedia($request){

        $property_media = $this->PropertyMediaModal()->getPropertyMediaByResourceId($request['property_resource_id']);        
        if($property_media){
            if (count($property_media->media_image) > 0) {
                foreach ($property_media->media_image as $media) {
                    if (!in_array($media->file_name, $request->input('media_image', []))) {
                        $media->delete();
                    }
                }
            }
            $media = $property_media->media_image->pluck('file_name')->toArray();
            foreach ($request->input('media_image', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $property_media->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('media_image');
                }
            }
        } else {
            $property_media = new PropertyMedia;
            $property_media->user_id = Auth::user()->id;
            $property_media->property_id = $request->property_id;
            $property_media->property_resource_id = $request->property_resource_id;
            if ($request->input('media_image', false)) {
                foreach ($request->input('media_image', []) as $file) {
                    $property_media->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('media_image');
                }
            } else {
                return  redirect()->back()->with('error' , 'Property image is required');
            }
            $property_media->save();
        }
        return redirect()->back()->with('success' , 'Property Media Added Successfully');

    }

    public function editPropertyMedia($resource_id){
        $property_resources = $this->propertyResourceModal()->getResourceWithMediaAndProperty($resource_id);
        return view('property_resources.edit_media', compact('property_resources'));
    }
    
}
