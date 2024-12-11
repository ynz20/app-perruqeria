<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        // Autenticar al usuario
        $request->authenticate();

        // Regenerar la sesión
        $request->session()->regenerate();

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verifica si el usuario es administrador
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard'); // Redirige a la vista de administrador
        }

        return redirect()->route('dashboard'); // Redirige a la vista normal
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
