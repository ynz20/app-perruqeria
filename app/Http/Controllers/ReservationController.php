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
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,dni',
            'reservation_date' => 'required|date',
            'user_id' => 'required|exists:users,dni',
            'service_id' => 'required|exists:services,id',
            'reservation_time' => 'required|date_format:H:i',
        ]);

        Reservation::create([
            'client_id' => $validatedData['client_id'],
            'user_id' => $validatedData['user_id'],
            'service_id' => $validatedData['service_id'],
            'reservation_date' => $validatedData['reservation_date'],
            'reservation_time' => $validatedData['reservation_time'],
            'status' => 'pendent',
        ]);
        

        return redirect()->route('reservation.create')->with('success', 'Reserva creada correctament.');
    }
}
