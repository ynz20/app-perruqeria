<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation; // Asegúrate de importar el modelo de Reservation
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Obtenim els usuaris que no són administradors (is_admin = 0)
        $users = $this->getNormalUsers();

        //Obtenim el mes y el any actual
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        //Obtenim les reserves d'aquest mes
        $reservas = Reservation::whereYear('reservation_date', $currentYear)
            ->whereMonth('reservation_date', $currentMonth)
            ->get();

        // Array dels dies d'aquest mes
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth)->daysInMonth;
        $days = [];

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $days[] = Carbon::createFromDate($currentYear, $currentMonth, $i);
        }

        return view('admin.dashboard', [
            'current_month'=> $currentMonth,
            'users' => $users,
            'reservas' => $reservas,
            'days' => $days,
        ]);
    }

    protected function getNormalUsers()
    {
        // Filtrar usuaris amb is_admin = 0
        return User::where('is_admin', 0)->get();
    }
}