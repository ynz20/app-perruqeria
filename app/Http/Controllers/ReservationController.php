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
    // Mètode per mostrar el formulari de creació de reserves
    public function create()
    {
        $clients = Client::all(); // Obté tots els clients
        $treballadors = User::all(); // Obté tots els treballadors
        $serveis = Service::all(); // Obté tots els serveis
        return view('addReservation', compact('clients', 'treballadors', 'serveis')); // Retorna la vista 'addReservation' amb les dades dels clients, treballadors i serveis
    }

    // Mètode per emmagatzemar una nova reserva
    public function store(Request $request)
    {
        // Valida les dades del formulari
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,dni', // ID del client és obligatori i ha d'existir a la taula clients
            'reservation_date' => 'required|date', // Data de la reserva és obligatòria i ha de ser una data vàlida
            'user_id' => 'required|exists:users,dni', // ID de l'usuari és obligatori i ha d'existir a la taula users
            'service_id' => 'required|exists:services,id', // ID del servei és obligatori i ha d'existir a la taula services
            'reservation_time' => 'required|date_format:H:i', // Hora de la reserva és obligatòria i ha de tenir el format H:i
        ]);

        // Busca el servei segons la ID recollida per agafar l'estimació
        $service = Service::find($validatedData['service_id']);
        // Pasem l'hora inicial a format "carbon" que ens ofereix PHP
        $reservationTime = Carbon::createFromFormat('H:i', $validatedData['reservation_time']);
        // Sumem els minuts de l'estimació al temps de reserva
        $reservationFinalization = $reservationTime->addMinutes($service->estimation);

        // Crea una nova reserva amb les dades validades
        Reservation::create([
            'client_id' => $validatedData['client_id'],
            'user_id' => $validatedData['user_id'],
            'service_id' => $validatedData['service_id'],
            'reservation_date' => $validatedData['reservation_date'],
            'reservation_time' => $validatedData['reservation_time'],
            'reservation_finalitzation' => $reservationFinalization,
            'status' => 'pendent', // Estat inicial de la reserva
        ]);

        // Redirigeix a la ruta 'reservation.create' amb un missatge de success
        return redirect()->route('reservation.create')->with('success', 'Reserva creada correctament.');
    }
}