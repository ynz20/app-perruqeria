<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.service', compact('services'));
    }

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

    public function edit($id)
    {
        // Obtenim el servei per modificar
        $service = Service::findOrFail($id);
        return view('admin.editService', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|between:0,999999.99',
            'estimation' => 'nullable|integer',
        ]);

        $service = Service::findOrFail($id);
        $service->update($validated);

        return redirect()->route('service.view')->with('success', 'El servei ha set modificat correctament.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        // Verificar si hi ha reserves associades
        if ($service->reservations()->count() > 0) {
            return redirect()->route('service.view')->with('error', 'No es pot eliminar el servei perquè hi ha reserves associades.');
        }

        $service->delete();

        return redirect()->route('service.view')->with('success', 'El servei ha estat eliminat correctament.');
    }
}
