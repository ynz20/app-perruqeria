<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function add(Request $request)
    {
        return view('addclient');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dni' => [
                'required',
                'string',
                'max:10',
                Rule::unique('clients', 'dni'),
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('clients', 'email'),
            ],
            'telf' => 'nullable|string|max:15',
        ]);

        Client::create($validated);

        return redirect()->route('client.add')->with('success', 'El client s’ha afegit correctament.');
    }
}
