<?php

// En UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // Importa el Facade de Auth

class UserController extends Controller
{

    public function index()
    {
        return view('user.dashboard'); // Asegúrate de tener esta vista creada
    }
    public function changeRoleToAdmin(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        if ($user) {
            // Verificar si el rol actual es 'user'
            if ($user->role === 'user') {
                // Cambiar el rol a 'admin'
                $user->role = 'admin';

                // Guardar los cambios en la base de datos
                $user->save();

                // Redirigir a la vista de dashboard con un mensaje de éxito
                return redirect()->route('user.dashboard')->with('status', 'Rol cambiado a Administrador exitosamente');
            }

            // Si el rol no es 'user', no se permite cambiarlo
            return redirect()->route('user.dashboard')->with('error', 'El rol no puede ser cambiado');
        }

        // Si el usuario no está autenticado, mostrar un error
        return redirect()->route('user.dashboard')->with('error', 'Error al cambiar el rol');
    }
}
