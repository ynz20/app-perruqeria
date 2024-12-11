<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        Reservation::create([
            'client_id' => '12345678A',
            'user_id' => '20572143T',
            'service_id' => 1,
            'reservation_date' => '2023-10-01',
            'reservation_time' => '10:00:00',
            'status' => 'confirmada',
        ]);

    }
}
