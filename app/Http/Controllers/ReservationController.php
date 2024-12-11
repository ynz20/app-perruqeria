<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Carbon;
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

        $service = Service::find($validatedData['service_id']); //Busquem el servei segons la id recollida per agafar l'estimació
        $reservationTime = Carbon::createFromFormat('H:i', $validatedData['reservation_time']); //Pasem en la hora inicial a format "carbon" que ens ofereix php
        $reservationFinalization = $reservationTime->addMinutes($service->estimation); //Sumem els minuts
        
        Reservation::create([
            'client_id' => $validatedData['client_id'],
            'user_id' => $validatedData['user_id'],
            'service_id' => $validatedData['service_id'],
            'reservation_date' => $validatedData['reservation_date'],
            'reservation_time' => $validatedData['reservation_time'],
            'reservation_finalitzation' => $reservationFinalization,
            'status' => 'pendent',
        ]);
        

        return redirect()->route('reservation.create')->with('success', 'Reserva creada correctament.');
    }
}
