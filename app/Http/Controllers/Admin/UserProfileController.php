<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Hash as PassHash;

class UserProfileController extends Controller
{
    public function show($id)
    {
        try {
            return $this->getUserProfileUtils()->showUserProfile($id);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            return $this->getUserProfileUtils()->updateUserProfile($request, $id);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function userPasswordChange(){

        try {
            return $this->getUserProfileUtils()->userPasswordChange();
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

}
