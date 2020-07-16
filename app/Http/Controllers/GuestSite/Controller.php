<?php

namespace App\Http\Controllers\GuestSite;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Utilties\CommonUtils;
use App\Http\GlobalUtilties\ImageUtils;
use App\Http\Utilties\GuestSiteUtils;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getCommonUtils() {
        return new CommonUtils();
    }

    public function getGuestSiteUtils() {
        return new GuestSiteUtils();
    }
}
