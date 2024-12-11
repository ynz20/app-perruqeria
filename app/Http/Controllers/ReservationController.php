<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;

class ReservationController extends Controller
{
    public function create()
    {
        $clients = Client::all();
        $treballadors = User::all();
        $serveis = Service::all();
        return view('addReservation', compact('clients', 'treballadors', 'serveis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,dni', 
            'treballador_id' => 'required|exists:users,dni',
        ]);

     
        $reservation = new Reservation();
        $reservation->client_id = $validated['client_id']; 
      
        $reservation->save();

        return redirect()->route('reservation.create')->with('success', 'Reserva creada correctament.');
    }
}
