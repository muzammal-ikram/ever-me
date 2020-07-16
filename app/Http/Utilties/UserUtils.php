<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use Illuminate\Support\Facades\Validator;


class UserUtils extends BaseUtility {

    public function deleteUser($id){
        $user = $this->userModal()->getUserById($id);
        $user->delete();
        return redirect()->back()->with('success', 'User has been  deleted.');
    }
    


}
