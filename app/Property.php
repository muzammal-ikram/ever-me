<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Traits\Shareable;
use phpDocumentor\Reflection\Types\Null_;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;


class Property extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;
    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    protected $table = 'properties';

    protected $primaryKey = 'id';

    protected $appends = [
        'property_image',
        'host_photo'
    ];

    protected $fillable = [
        'property_name', 'property_address', 'property_city', 'property_state', 
        'property_zipcode', 'lat_long', 'property_image', 'host_info', 'host_name', 'host_photo', 'host_phone',
        'host_other_phone', 'host_platform', 'is_protected', 
        'preference', 'seo_hide', 'password',
    ];


    public function getPropertyById($property_id){
        $property = Property::findOrFail($property_id);
        return $property;
    }

    public function getPropertyWithResources($property_id){
        $property_resources = Property::where('id', $property_id)->with('property_resources')->first()->toArray();
        return $property_resources;
    }

    public function property_resources()
    {
        return $this->hasMany('App\PropertyResource');
    }

    public function propertyplatforms()
    {
        return $this->belongsToMany(Platform::class, 'property_platform');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(200)->height(200);
    }

    public function getPropertyImageAttribute()
    {
        $files = $this->getMedia('property_image')->last();
        if($files != Null){
            $files->each(function ($item) {
                $item->url       = $item->getUrl();
                $item->thumbnail = $item->getUrl('thumb');
            });
            return $files;
        }
    }

    public function getHostPhotoAttribute()
    {
        $files = $this->getMedia('host_photo')->last();
        if($files != Null){
            $files->each(function ($item) {
                $item->url       = $item->getUrl();
                $item->thumbnail = $item->getUrl('thumb');
            });
            return $files;
        }
    }
}
