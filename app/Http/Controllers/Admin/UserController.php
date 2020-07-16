<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\User;

class UserController extends Controller
{
    
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    public function destroy($id)
    {
        try {
            return $this->getUserUtils()->deleteUser($id);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

}
