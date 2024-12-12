<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'client_id',
        'user_id',
        'service_id',
        'reservation_date',
        'reservation_time',
        'reservation_finalitzation',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'dni');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'dni');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
