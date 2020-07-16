<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class PropertyMedia extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'property_media';

    protected $fillable = [
        'property_id', 'property_resource_id', 'media_image'    
    ];

    protected $appends = [
        'media_image',
    ];

    public function getPropertyMediaByResourceId($property_resource_id){
        $property_media = PropertyMedia::where('property_resource_id', $property_resource_id)->first();
        return $property_media;
    }

    public function property_property_resource()
    {
        return $this->belongsTo('App\PropertyResource');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function getMediaImageAttribute()
    {
        $files = $this->getMedia('media_image');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
        });

        return $files;
    }

}
