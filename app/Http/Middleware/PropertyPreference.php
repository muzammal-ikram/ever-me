<?php

namespace App\Http\Middleware;

use Closure;
use App\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PropertyPreference
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       $parameter = $request->route()->parameters();
    //    dd($parameter);
       $property = Property::where('id', $parameter['property_id'])->first();
        if(!Auth::guest() && ($property['preference'] == 0 || $property['preference'] == 1))
        {
            return $next($request);
        } 
        elseif (Auth::guest() && $property['preference'] == 1) {
            return redirect('guest/property_preference_password/'.$parameter['property_id'].'');
        }
        elseif (Auth::guest() && $property['preference'] == 0) {
            return $next($request);
        }
        else {
            return abort(403, 'Unauthorized action.');

        }
        
    }
}
