<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function add(Request $request)
    {
        return view('addclient');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:clients,dni',
            'telf' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);
        Client::create($validatedData);

        return redirect()->route('client.add')->with('success', 'Client afegit correctament!');
    }
}
