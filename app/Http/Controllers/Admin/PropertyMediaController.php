<?php

namespace App\Http\Controllers\Admin;

use App\Property;
use App\PropertyResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\PropertyMedia;

class PropertyMediaController extends Controller
{
    use MediaUploadingTrait; 
  
    public function store(Request $request)
    {
        try {
            return $this->getPropertyMediaUtils()->storePropertyMedia($request);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function edit($resource_id)
    {
        try {
            return $this->getPropertyMediaUtils()->editPropertyMedia($resource_id);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

}
