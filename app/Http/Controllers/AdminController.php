<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
       //Obtenim els usuaris amb el rol user
        $users = $this->getUsersWithRole('user');

      
        return view('admin.dashboard', ['users' => $users]);
    }


    protected function getUsersWithRole($role)
    {
        return User::where('role', $role)->get();
    }
}
