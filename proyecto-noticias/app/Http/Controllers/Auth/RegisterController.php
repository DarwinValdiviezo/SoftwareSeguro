<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(Request $r)
    {
        $r->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = User::create([
            'name'     => $r->name,
            'email'    => $r->email,
            'password' => Hash::make($r->password),
        ]);

        // Asignar rol “user” por defecto
        $user->assignRole('user');

        // Redirigir a login
        return redirect()->route('login.form')
                         ->with('status','Registro exitoso. Por favor inicia sesión.');
    }
}
