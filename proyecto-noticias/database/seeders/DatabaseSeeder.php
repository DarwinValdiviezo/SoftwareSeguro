<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1) Crear roles y permisos
        $this->call(RolesAndPermissionsSeeder::class);

        // 2) Crear usuario admin
        $this->call(AdminUserSeeder::class);

        // 3) (Opcional) Crear algunos usuarios de prueba
        // \App\Models\User::factory(10)->create();
    }
}
