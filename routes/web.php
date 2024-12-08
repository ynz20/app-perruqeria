<?php

use app\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/addclient', [ClientController::class, 'add'])->name('client.add');
    Route::post('/addclient', [ClientController::class, 'store'])->name('client.store');

     Route::get('/addreservation', [ReservationController::class, 'create'])->name('reservation.create'); // Vista del formulario
    Route::post('/addreservation', [ReservationController::class, 'store'])->name('reservation.store'); // Almacenar reserva
});

require __DIR__.'/auth.php';
