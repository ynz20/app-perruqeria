<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function add(Request $request): View
    {
        return view('addclient', [
            'user' => $request->user(),
        ]);
    }
}
