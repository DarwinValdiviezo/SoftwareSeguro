<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'darwin.valdiviezo001@gmail.com'],
            [
                'name'              => 'Darwin Valdiviezo',
                // Cambia la contraseña a la que prefieras:
                'password'          => Hash::make('Secret123!'),
                'email_verified_at' => now(),
            ]
        );

        // Asignar rol admin si el modelo tiene el trait HasRoles
        if (method_exists($admin, 'assignRole')) {
            $admin->assignRole('admin');
        }
    }
}
