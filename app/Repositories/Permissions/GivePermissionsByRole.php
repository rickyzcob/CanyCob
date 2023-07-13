<?php

namespace App\Repositories\Permissions;

use Spatie\Permission\Models\Role;

class GivePermissionsByRole
{
    public function givePermissions($client_id = null)
    {

        $roleDB = Role::query()->where('tenant_id', $client_id)->get();

        foreach ($roleDB as $itemRole) {
            if($itemRole['name'] == 'Administrador'){
                $administrator = new GivePermissionsByAdministrator();
                $itemRole->syncPermissions($administrator->permissionsAdministrator());
            } elseif ($itemRole['name'] == 'Cobrança') {
                $administrator = new GivePermissionsByCharge();
                $itemRole->syncPermissions($administrator->permissionsCharge());
            } elseif ($itemRole['name'] == 'Acordos') {
                $administrator = new GivePermissionsByAgreement();
                $itemRole->syncPermissions($administrator->permissionsAgreement());
            } elseif ($itemRole['name'] == 'Gerencia') {
                $administrator = new GivePermissionsByManager();
                $itemRole->syncPermissions($administrator->permissionsManager());
            }
        }
    }
}




