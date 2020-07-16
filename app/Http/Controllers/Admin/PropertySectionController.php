<?php

namespace App\Http\Controllers\Admin;


use App\PropertyResource;
use App\PropertySection;
use App\SectionInformation;
use Illuminate\Http\Request;
use App\DataTables\PropertySectionsDatatable;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\TabClass;
use App\Property;

class PropertySectionController extends Controller
{

    public function index($property_id, $property_resource_id)
    {
        try {
            return $this->getPropertySectionUtils()->getSections($property_id, $property_resource_id);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function create()
    {
        try {
            return $this->getPropertySectionUtils()->createSectionView();
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function store($property_id , $property_resource_id)
    {
        try {
            return $this->getPropertySectionUtils()->storeSection($property_id , $property_resource_id);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function edit($property_id , $property_resource_id , PropertySection $property_section)
    {
        try {
            return $this->getPropertySectionUtils()->editSectionView($property_section);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
        return view('property_sections.edit', compact('property_section'));
    }

    public function update()
    {
        try {
            return $this->getPropertySectionUtils()->updateSection();
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function deleteSection($section_id)
    {
        try {
            return $this->getPropertySectionUtils()->deleteSection($section_id);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }


    public function sectionSortable(Request $request){

        try {
            return $this->getPropertySectionUtils()->sectionSortable($request);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }
}
