<?php

namespace App\Repositories\Permissions;

use Spatie\Permission\Models\Role;

class CreateRolesRepository
{
    public function createRolesbyClient($tenant_id = null, $guard_name = null)
    {
        $roles = [
            ['name' => 'Administrador'],
            ['name' => 'Cobrança'],
            ['name' => 'Gerencia'],
            ['name' => 'Visitante'],
        ];

        foreach ($roles as $role) {
            Role::create([
                'tenant_id' => $tenant_id,
                'name' => $role['name'],
                'guard_name' => $guard_name
            ]);
        }
    }
}
