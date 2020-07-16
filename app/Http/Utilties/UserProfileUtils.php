<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use Illuminate\Support\Facades\Validator;
use App\User;
use Request;
use Hash as PassHash;



class UserProfileUtils extends BaseUtility {

    public function showUserProfile($id){
        $user = $this->userModal()->getUserById($id);
        return view('user_profile.edit', compact('user'));
    }

    public function updateUserProfile($request, $id){

        $user = $this->userModal()->getUserById($id);
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone'  => 'required|numeric',      
        ]); 
        return $this->continueUpdateUserProfile($request, $user);
    }

    public function continueUpdateUserProfile($request, $user){

        if($profile_image = $request->file('profile_image')){
            $profile_image_path = User::profileImageUpload($user, $profile_image);
        }
        else{
            $profile_image_path = $user->profile_image;
        }

        $user->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'company_name'=> $request->company_name,
            'phone'=> $request->phone,
            'other_phone'=> $request->other_phone,
            'profile_image'=> $profile_image_path
        ]);
        return redirect()->back()->with('success', 'Profile Updated Successfully.');
    }

    public function userPasswordChange(){

        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->user_password_change);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors()->first());
        }

        // if (!(PassHash::check($request->get('current_password'), auth()->user()->password))) {
        //     return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        // }
        
        //Change Password
        $user = auth()->user();
        $user->password = PassHash::make($request_params['password']);
        $user->save();

        return redirect()->back()->with("success","Password changed successfully!");

    }

}
