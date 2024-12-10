<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Importa el Facade d'Auth

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Ruta del tauler de control per a usuaris autenticats i verificats
Route::get('/dashboard', function () {
    $user = Auth::user(); // Obtenir l'usuari autenticat
    return view('dashboard', compact('user')); // Passar l'usuari a la vista
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutes per a administradors
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Rutes per afegir serveis (només administradors)
    Route::get('/addservice', [ServiceController::class, 'add'])->name('service.add');
    Route::post('/addservice', [ServiceController::class, 'store'])->name('service.store');
});

// Rutes per a usuaris autenticats
Route::middleware('auth',)->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/addclient', [ClientController::class, 'add'])->name('client.add');
    Route::post('/addclient', [ClientController::class, 'store'])->name('client.store');

    Route::post('/change-role-to-admin/{dni}', [UserController::class, 'changeRoleToAdmin'])->name('user.changeRoleToAdmin');

    Route::get('/addreservation', [ReservationController::class, 'create'])->name('reservation.create'); // Vista del formulari
    Route::post('/addreservation', [ReservationController::class, 'store'])->name('reservation.store'); // Emmagatzemar reserva
});

// Requereix el fitxer d'autenticació
require __DIR__ . '/auth.php';