<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Validation\Rule;

class ClientController extends Controller 
{
    // Mètode per mostrar el formulari d'afegir un client
    public function add(Request $request)
    {
        return view('addclient'); // Retorna la vista 'addclient'
    }

    // Mètode per emmagatzemar un nou client
    public function store(Request $request)
    {
        // Valida les dades del formulari
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Nom és obligatori, ha de ser una cadena i no pot superar 255 caràcters
            'surname' => 'required|string|max:255', // Cognom és obligatori, ha de ser una cadena i no pot superar 255 caràcters
            'dni' => [
                'required', // DNI és obligatori
                'string', // Ha de ser una cadena
                'max:10', // No pot superar 10 caràcters
                Rule::unique('clients', 'dni'), // Ha de ser únic en la taula 'clients'
            ],
            'email' => [
                'nullable', // Email és opcional
                'email', // Ha de ser un correu electrònic vàlid
                Rule::unique('clients', 'email'), // Ha de ser únic en la taula 'clients'
            ],
            'telf' => 'nullable|string|max:15', // Telèfon és opcional, ha de ser una cadena i no pot superar 15 caràcters
        ]);

        // Crea un nou client amb les dades validades
        Client::create($validated);

        // Redirigeix a la ruta 'client.add' amb un missatge de success
        return redirect()->route('client.add')->with('success', 'El client s’ha afegit correctament.');
    }
}