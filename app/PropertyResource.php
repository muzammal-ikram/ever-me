<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyResource extends Model
{
    use SoftDeletes;

    protected $table = 'property_resources';

    protected $fillable = [
        'user_id', 'property_id', 'title', 'icon', 'contain_profile_property', 'nearby', 'media'
    ];

    public function getResourceByIdWithProperty($property_resource_id){
        if($property_resource_id){
            $property_resources = PropertyResource::where('id', $property_resource_id)->with('Property')->first();
            return $property_resources;
        }
    }

    public function getResourceWithMediaAndProperty($property_resource_id){
        if($property_resource_id){
            $property_resources = PropertyResource::where('id', $property_resource_id)->with('property_property_media')->with('Property')->first();
            return $property_resources;
        }
    }

    public function getPropertyResourceById($resource_id){
        $property_resource = PropertyResource::where('id', $resource_id)->first();
        return $property_resource;
    }

    public function Property()
    {
        return $this->belongsTo('App\Property');
    }

    public function property_property_sections()
    {
        return $this->hasMany('App\PropertySection');
    }

    public function property_property_media()
    {
        return $this->hasOne('App\PropertyMedia');
    }

}
