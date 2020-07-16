<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;



class SectionInformation extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $table = 'section_informations';

    protected $fillable = [
        'title', 'image_url', 'video_url'
    ];
    
    public $timestamps = true;
    
    protected $guarded = ['id'];

    protected $appends = [
        'image_url',
    ];

    public function getInfoById($info_id){
        $info = SectionInformation::findOrFail($info_id);
        return $info;

    }

    public function getPropertyInfoBySectionId($section_id){
        $property_resource = SectionInformation::where('property_section_id', $section_id)->first();
        return $property_resource;
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function getImageUrlAttribute()
    {
        $files = $this->getMedia('image_url')->last();
        if($files != Null){
            $files->each(function ($item) {
                $item->url       = $item->getUrl();
                $item->thumbnail = $item->getUrl('thumb');
            });
            return $files;
        } 
    }

    public function sectionResource()
    {
        return $this->belongsTo('App\PropertySection');
    }
}
