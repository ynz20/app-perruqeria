<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create()
    {
        $clients = Client::all();
        return view('addReservation', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id', // Validar que el cliente existe
            // Aquí añade otras validaciones necesarias para las reservas
        ]);

        // Lógica para guardar la reserva
        // Reservation::create($validated);

        return redirect()->route('reservation.create')->with('success', 'Reserva creada correctament.');
    }
}
