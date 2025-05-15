<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TwoFactorCode;
use SendGrid\Mail\Mail;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de login.
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesa el login:
     * - En “modo seguro” usa Auth::attempt() (hash de contraseñas).
     * - En “modo inseguro” permite SQLi y devuelve JSON para demo.
     * - Luego genera un código 2FA, lo envía por SendGrid y redirige a verify.
     */
    public function login(Request $request)
    {
        // Validación básica
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $emailInput = $request->input('email');
        $password   = $request->input('password');
        $secure     = $request->has('seguro');

        // 1) Autenticación segura vs insegura
        if ($secure) {
            if (! Auth::attempt(['email' => $emailInput, 'password' => $password])) {
                return back()->withErrors(['login' => 'Credenciales incorrectas']);
            }
            $user = Auth::user();
        } else {
            // DEMO inseguro: concatenación directa (para SQLi) — solo si tienes passwords en texto plano
            $query    = "SELECT * FROM users WHERE email = '{$emailInput}' AND password = '{$password}'";
            $usuarios = DB::select($query);

            if (count($usuarios) > 1) {
                // Muestra JSON con todos los usuarios
                return response()->json($usuarios);
            }

            $user = $usuarios[0] ?? null;
            if (! $user) {
                return back()->withErrors(['login' => 'Credenciales incorrectas']);
            }
        }

        // 2) Generar y guardar código 2FA
    $code = rand(100000, 999999);
    TwoFactorCode::updateOrCreate(
        ['user_id'    => $user->id],
        ['code'       => $code, 'created_at' => now()]
    );

        // 3) Enviar código vía SendGrid API
$emailMessage = new \SendGrid\Mail\Mail();
$emailMessage->setFrom("darwin.valdiviezo001@gmail.com", "Mi App Laravel");
        $emailMessage->setSubject("Tu código de inicio de sesión");
        $emailMessage->addTo($user->email, $user->name);
        $emailMessage->addContent(
            "text/plain",
            "Hola {$user->name}, tu código de verificación es: {$code}. Expira en 10 minutos."
        );

        try {
            $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
            $response = $sendgrid->send($emailMessage);
            \Log::info("SendGrid status: {$response->statusCode()}");
\Log::info("SendGrid body: " . $response->body());

        } catch (\Exception $e) {
            \Log::error("Error SendGrid 2FA: ".$e->getMessage());
            return back()->withErrors(['login' => 'No se pudo enviar el código de verificación.']);
        }

        // 4) Redirigir al formulario de verificación 2FA
    $request->session()->put('user_id', $user->id);
    return redirect()->route('verify.form');
    }

    /**
     * Cierra la sesión (logout).
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
