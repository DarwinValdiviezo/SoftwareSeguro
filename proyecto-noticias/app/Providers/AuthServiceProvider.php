<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mapeo de políticas de autorización.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Registra políticas y rutas de Passport.
     */
    public function boot()
   {
    $this->registerPolicies();
    Passport::routes();

    // tokens de acceso expiran en 1 hora
    Passport::tokensExpireIn(now()->addHour());
    // refresh tokens expiran en 30 días
    Passport::refreshTokensExpireIn(now()->addDays(30));
}
}
