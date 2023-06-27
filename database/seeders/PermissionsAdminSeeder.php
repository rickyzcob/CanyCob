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
        Permission::query()->delete();
        GroupPermissions::query()->delete();

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $group = GroupPermissions::create(['name' => 'Configurações - Cadastro de Usuários']);

        $permissions = [
            ['name' => 'admin_add_user', 'label' => 'Adicionar'],
            ['name' => 'admin_edit_user', 'label' => 'Editar'],
            ['name' => 'admin_view_user', 'label' => 'Visualizar'],
            ['name' => 'admin_delete_user', 'label' => 'Deletar ']
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Configurações - Cadastro de Permissões']);

        $permissions = [
            ['name' => 'admin_add_permission', 'label' => 'Adicionar'],
            ['name' => 'admin_edit_permission', 'label' => 'Editar'],
            ['name' => 'admin_view_permission', 'label' => 'Visualizar'],
            ['name' => 'admin_delete_permission', 'label' => 'Deletar'],
            ['name' => 'admin_roles_permission', 'label' => 'Permissões'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Configurações - Cor e Logo']);

        $permissions = [
            ['name' => 'admin_add_configuration', 'label' => 'Adicionar'],
            ['name' => 'admin_edit_configuration', 'label' => 'Editar'],
            ['name' => 'admin_view_configuration', 'label' => 'Visualizar'],
            ['name' => 'admin_delete_configuration', 'label' => 'Deletar'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Cadastro - Franqueados']);

        $permissions = [
            ['name' => 'admin_add_franchising', 'label' => 'Adicionar'],
            ['name' => 'admin_edit_franchising', 'label' => 'Editar'],
            ['name' => 'admin_view_franchising', 'label' => 'Visualizar'],
            ['name' => 'admin_delete_franchising', 'label' => 'Deletar'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Cadastro - Status da Cobrança']);

        $permissions = [
            ['name' => 'admin_add_type_status_charges', 'label' => 'Adicionar'],
            ['name' => 'admin_edit_type_status_charges', 'label' => 'Editar'],
            ['name' => 'admin_view_type_status_charges', 'label' => 'Visualizar'],
            ['name' => 'admin_delete_type_status_charges', 'label' => 'Deletar'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Cadastro - Tipos de Recisão']);

        $permissions = [
            ['name' => 'tenant_add_type_termination', 'label' => 'Adicionar'],
            ['name' => 'tenant_edit_type_termination', 'label' => 'Editar'],
            ['name' => 'tenant_view_type_termination', 'label' => 'Visualizar'],
            ['name' => 'tenant_delete_type_termination', 'label' => 'Deletar'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }


        $group = GroupPermissions::create(['name' => 'Cadastro - Tipo de Vendas']);

        $permissions = [
            ['name' => 'tenant_add_type_sales', 'label' => 'Adicionar'],
            ['name' => 'tenant_edit_type_sales', 'label' => 'Editar'],
            ['name' => 'tenant_view_type_sales', 'label' => 'Visualizar'],
            ['name' => 'tenant_delete_type_sales', 'label' => 'Deletar'],
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
