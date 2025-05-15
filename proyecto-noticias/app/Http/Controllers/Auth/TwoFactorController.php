<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;       // <— Importa el facade
use App\Models\TwoFactorCode;
use App\Models\User;

class TwoFactorController extends Controller
{
    /**
     * Muestra el formulario donde el usuario ingresa el código 2FA.
     */
    public function show(Request $request)
    {
        if (! $request->session()->has('user_id')) {
            return redirect()->route('login.form');
        }
        return view('auth.verify');
    }

    /**
     * Valida el código 2FA enviado por el usuario.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $userId = $request->session()->get('user_id');
        $tf     = TwoFactorCode::where('user_id', $userId)
                   ->where('code', $request->code)
                   ->first();

        if (! $tf) {
            return back()->withErrors(['code' => 'Código no encontrado.']);
        }

        // Verificar expiración
        if (now()->diffInMinutes($tf->created_at) > 10) {
            $tf->delete();
            return back()->withErrors(['code' => 'Código expirado.']);
        }

        // Código válido, elimínalo
        $tf->delete();

        // 1) Autentica al usuario con el facade Auth
        $user = User::findOrFail($userId);
        Auth::login($user);

        // 2) Regenera la sesión para que Laravel marque al usuario como auth
        $request->session()->regenerate();

        // 3) Limpia la sesión temporal
        $request->session()->forget('user_id');

        // 4) Redirige a las noticias
        return redirect()->intended(route('news.index'));
    }
}
