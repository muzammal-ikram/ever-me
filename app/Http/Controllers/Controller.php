<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Utilties\CommonUtils;
use App\Http\GlobalUtilties\ImageUtils;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getCommonUtils() {
        return new CommonUtils();
    }

    public function getImagetils() {
        return new ImageUtils();
    }
}
