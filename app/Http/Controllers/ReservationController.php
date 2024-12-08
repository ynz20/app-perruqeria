<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Reservation;

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
            'client_id' => 'required|exists:clients,dni', // Validar que el ID del cliente exista
        ]);

        // Lógica para guardar la reserva
        $reservation = new Reservation();
        $reservation->client_id = $validated['client_id']; // Asignar el ID del cliente a la reserva
        // Asignar otros campos de la reserva según sea necesario
        $reservation->save();

        return redirect()->route('reservation.create')->with('success', 'Reserva creada correctament.');
    }
}
