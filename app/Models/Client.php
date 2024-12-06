<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['dni', 'name', 'surname', 'telf', 'email'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
