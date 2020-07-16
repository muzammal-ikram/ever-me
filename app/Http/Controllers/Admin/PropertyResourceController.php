<?php

namespace App\Http\Controllers\Admin;

class PropertyResourceController extends Controller
{   
    public function index($property_id)
    {
        try {
            return $this->getPropertyResourceUtils()->getResources($property_id);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }
}
