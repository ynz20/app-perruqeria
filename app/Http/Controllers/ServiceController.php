<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function add(Request $request)
    {
        return view('admin.addService');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|between:0,999999.99',
            'estimation' => 'nullable|integer',
        ]);

        Service::create($validated);

        return redirect()->route('service.add')->with('success', 'El servei ha set afegit correctament.');
    }
}
