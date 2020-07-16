<?php

namespace App\Http\Controllers\Admin;

use App\Property;
use App\DataTables\PropertiesDatatable;
use App\Http\Controllers\Traits\MediaUploadingTrait;


class PropertyController extends Controller
{
    use MediaUploadingTrait;

    public function index(PropertiesDatatable $dataTable)
    {
        return $dataTable->render('properties.index');
    }

    public function create()
    {
        try {
            return $this->propertyUtils()->createProperty();
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function store()
    {
        try {
            return $this->propertyUtils()->storeProperty();
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function edit(Property $property)
    {
        try {
            return $this->propertyUtils()->editProperty($property);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    } 

    public function update(Property $property)
    {
        try {
            return $this->propertyUtils()->updateProperty($property);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function destroy(Property $property)
    {
        try {
            return $this->propertyUtils()->deleteProperty($property);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function updatePreference() 
    {
        try {
            return $this->propertyUtils()->updatePreference();
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

}
