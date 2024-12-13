<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Mètode per mostrar el tauler d'usuari
    public function index()
    {
        return view('user.dashboard'); // Retorna la vista 'user.dashboard'
    }

    // Mètode per canviar el rol d'un usuari a administrador
    public function changeRoleToAdmin(Request $request, $id)
    {
        // Obtenir l'usuari autenticat
        $authUser  = Auth::user();

        // Verificar si l'usuari autenticat és un administrador
        if ($authUser) {
            // Buscar l'usuari el rol del qual es vol canviar
            $user = User::find($id);
            if ($user) {
                // Verificar si l'usuari no és ja un administrador
                if (!$user->is_admin) {
                    // Canviar l'estat a administrador
                    $user->is_admin = 1;

                    // Desar els canvis a la base de dades
                    $user->save();

                    // Redirigir a la vista de dashboard amb un missatge d'èxit
                    return redirect()->route('admin.dashboard')->with('status', 'Rol canviat a Administrador amb èxit');
                }

                // Si l'usuari ja és administrador, no es permet canviar-lo
                return redirect()->route('admin.dashboard')->with('error', 'L\'usuari ja és Administrador');
            }

            // Si l'usuari no existeix, mostrar un error
            return redirect()->route('admin.dashboard')->with('error', 'Usuari no trobat');
        }

        // Si l'usuari no està autenticat o no és admin, mostrar un error
        return redirect()->route('dashboard')->with('error', 'No tens permís per canviar el rol');
    }
}