<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\SectionInformation;
use App\PropertySection;
use Auth,Exception;
use Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use App\Http\Utilties\CommonUtils;
use App\Http\Controllers\Traits\MediaUploadingTrait;

class SectionInformationController extends Controller
{
    use MediaUploadingTrait;
   
    public function store(Request $request)
    {
        try {
            return $this->getSectionInfoUtils()->storeInformation();
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            return $this->getSectionInfoUtils()->editInformation($id);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function update($id)
    {
        try {
            return $this->getSectionInfoUtils()->updateInformation($id);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            return $this->getSectionInfoUtils()->deleteInformation($id);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

}
