<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class PropertySection extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $table = 'property_sections';

    protected $fillable = ['order'];

    public function getSectionWithInformation($property_id, $property_resource_id){
        $sections = PropertySection::where(['property_id' => $property_id,'property_resource_id' => $property_resource_id])->with('property_section_information')->orderBy('order','ASC')->get();        
        return $sections;
    }

    public function getSectionById($section_id){
        $section = PropertySection::findOrFail($section_id);
        return $section;
    }


    public function PropertyResource()
    {
        return $this->belongsTo('App\PropertyResource');
    }

    public function property_section_information()
    {
        return $this->hasMany('App\SectionInformation');
    }


}
