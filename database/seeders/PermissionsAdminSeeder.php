<?php

namespace Database\Seeders;

use App\Models\GroupPermissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Permission::query()->delete();
//        GroupPermissions::query()->delete();
//
//        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $group = GroupPermissions::create(['name' => 'Configurações - Cadastro de Usuários', 'scope' => 'Admin']);

        $permissions = [
            ['name' => 'admin_add_user', 'label' => 'Adicionar', 'scope' => 'Admin'],
            ['name' => 'admin_edit_user', 'label' => 'Editar', 'scope' => 'Admin'],
            ['name' => 'admin_view_user', 'label' => 'Visualizar', 'scope' => 'Admin'],
            ['name' => 'admin_delete_user', 'label' => 'Deletar ', 'scope' => 'Admin']
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Configurações - Cadastro de Permissões', 'scope' => 'Admin']);

        $permissions = [
            ['name' => 'admin_add_permission', 'label' => 'Adicionar', 'scope' => 'Admin'],
            ['name' => 'admin_edit_permission', 'label' => 'Editar', 'scope' => 'Admin'],
            ['name' => 'admin_view_permission', 'label' => 'Visualizar', 'scope' => 'Admin'],
            ['name' => 'admin_delete_permission', 'label' => 'Deletar', 'scope' => 'Admin'],
            ['name' => 'admin_roles_permission', 'label' => 'Permissões', 'scope' => 'Admin'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Configurações - Cor e Logo', 'scope' => 'Admin']);

        $permissions = [
            ['name' => 'admin_add_configuration', 'label' => 'Adicionar', 'scope' => 'Admin'],
            ['name' => 'admin_edit_configuration', 'label' => 'Editar', 'scope' => 'Admin'],
            ['name' => 'admin_view_configuration', 'label' => 'Visualizar', 'scope' => 'Admin'],
            ['name' => 'admin_delete_configuration', 'label' => 'Deletar', 'scope' => 'Admin'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Cadastro - Franqueados', 'scope' => 'Admin']);

        $permissions = [
            ['name' => 'admin_add_franchising', 'label' => 'Adicionar', 'scope' => 'Admin'],
            ['name' => 'admin_edit_franchising', 'label' => 'Editar', 'scope' => 'Admin'],
            ['name' => 'admin_view_franchising', 'label' => 'Visualizar', 'scope' => 'Admin'],
            ['name' => 'admin_delete_franchising', 'label' => 'Deletar', 'scope' => 'Admin'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }
    }
}
