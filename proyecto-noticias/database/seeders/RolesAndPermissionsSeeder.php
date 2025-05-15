<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Crear permisos
        $viewNews   = Permission::firstOrCreate(['name' => 'view news']);
        $manageNews = Permission::firstOrCreate(['name' => 'manage news']);

        // 2) Crear rol “user” y darle permiso de ver noticias
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->syncPermissions($viewNews);

        // 3) Crear rol “admin” y darle ambos permisos
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions([$viewNews, $manageNews]);
    }
}
