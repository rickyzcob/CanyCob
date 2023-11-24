<?php

namespace Database\Seeders;

use App\Models\GroupPermissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissonScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = GroupPermissions::create(['name' => 'Permissões - Agenda']);

        $permissions = [
            ['name' => 'tenant_add_schedule', 'label' => 'Adicionar'],
            ['name' => 'tenant_edit_schedule', 'label' => 'Editar'],
            ['name' => 'tenant_view_schedule', 'label' => 'Visualizar'],
            ['name' => 'tenant_delete_schedule', 'label' => 'Deletar '],
            ['name' => 'tenant_view_schedule_all', 'label' => 'Visualizar Todos'],
            ['name' => 'tenant_view_schedule_user', 'label' => 'Visualizar Somente Usuário'],
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
