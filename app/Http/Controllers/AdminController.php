<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // Obtenim els usuaris que no són administradors (is_admin = 0)
        $users = $this->getNormalUsers();

        return view('admin.dashboard', ['users' => $users]);
    }

    protected function getNormalUsers()
    {
        // Filtrar usuaris amb is_admin = 0
        return User::where('is_admin', 0)->get();
    }
}