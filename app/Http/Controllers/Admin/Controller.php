<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Utilties\CommonUtils;
use App\Http\GlobalUtilties\ImageUtils;
use App\Http\Utilties\PropertyUtils;
use App\Http\Utilties\PropertyMediaUtils;
use App\Http\Utilties\UserUtils;
use App\Http\Utilties\PropertyResourceUtils;
use App\Http\Utilties\PropertySectionUtils;
use App\Http\Utilties\SectionInfoUtils;
use App\Http\Utilties\UserProfileUtils;
use App\Platform;
use App\Property;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getCommonUtils() {
        return new CommonUtils();
    }

    public function getImagetils() {
        return new ImageUtils();
    }

    public function propertyUtils() {
        return new PropertyUtils();
    }

    public function getPropertyMediaUtils() {
        return new PropertyMediaUtils();
    }

    public function getUserUtils() {
        return new UserUtils();
    }

    public function getUserProfileUtils() {
        return new UserProfileUtils();
    }

    public function getPropertyResourceUtils() {
        return new PropertyResourceUtils();
    }

    public function getPropertySectionUtils() {
        return new PropertySectionUtils();
    }

    public function getSectionInfoUtils() {
        return new SectionInfoUtils();
    }

    public function platformModal() {
        return new Platform();
    }

    public function propertyModal() {
        return new Property();
    }
}
