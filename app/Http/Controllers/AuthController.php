<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $adminUsername = config('app.admin_username');
        $adminPassword = config('app.admin_password');

        if ($request->username === $adminUsername && $request->password === $adminPassword) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard')->with('success', '¡Bienvenido!');
        }

        return back()->with('error', 'Credenciales incorrectas.');
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}
