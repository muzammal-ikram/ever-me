<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $table = 'platforms';

    protected $fillable = [
        'name'
    ];

    public function propertyplatforms()
    {
        return $this->belongsToMany(Property::class, 'property_platform');
    }

    public function getAllPlatform(){
        $platform = Platform::get()->toArray();
        return $platform;
    }

}
