<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reservation; // Asegúrate de importar el modelo de Reservation
use Carbon\Carbon;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Ruta del tauler de control per a usuaris autenticats i verificats
Route::get('/dashboard', function () {
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
    $user = Auth::user(); // Obtenir l'usuari autenticat

    return view('dashboard', compact('user','reservas','days')); // Passar l'usuari a la vista
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutes per a administradors
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Rutes per afegir serveis (només administradors)
    Route::get('/renderservice', [ServiceController::class, 'index'])->name('service.view');
    Route::get('/addservice', [ServiceController::class, 'add'])->name('service.add');
    Route::post('/addservice', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('/service/update/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/service/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
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
