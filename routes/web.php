<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth','verified')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/addclient', [ClientController::class, 'add'])->name('client.add');
    Route::post('/addclient', [ClientController::class, 'store'])->name('client.store');

    Route::get('/addreservation', [ReservationController::class, 'create'])->name('reservation.create'); // Vista del formulari
    Route::post('/addreservation', [ReservationController::class, 'store'])->name('reservation.store'); // Almacenar reserva

    Route::get('/addservice', [ServiceController::class, 'add'])->name('service.add');
    Route::post('/addservice', [ServiceController::class, 'store'])->name('service.store');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/change-role-to-admin', [UserController::class, 'changeRoleToAdmin'])->name('user.changeRoleToAdmin');
});

require __DIR__ . '/auth.php';
