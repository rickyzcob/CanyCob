<?php

namespace Database\Seeders;

use App\Models\GroupPermissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
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
            ['name' => 'add_user', 'label' => 'Adicionar'],
            ['name' => 'edit_user', 'label' => 'Editar'],
            ['name' => 'view_user', 'label' => 'Visualizar'],
            ['name' => 'delete_user', 'label' => 'Deletar ']
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
            ['name' => 'add_permission', 'label' => 'Adicionar'],
            ['name' => 'edit_permission', 'label' => 'Editar'],
            ['name' => 'view_permission', 'label' => 'Visualizar'],
            ['name' => 'delete_permission', 'label' => 'Deletar'],
            ['name' => 'roles_permission', 'label' => 'Permissões'],
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
            ['name' => 'add_configuration', 'label' => 'Adicionar'],
            ['name' => 'edit_configuration', 'label' => 'Editar'],
            ['name' => 'view_configuration', 'label' => 'Visualizar'],
            ['name' => 'delete_configuration', 'label' => 'Deletar'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Cadastros - Franquias']);

        $permissions = [
            ['name' => 'add_franchising', 'label' => 'Adicionar'],
            ['name' => 'edit_franchising', 'label' => 'Editar'],
            ['name' => 'view_franchising', 'label' => 'Visualizar'],
            ['name' => 'delete_franchising', 'label' => 'Deletar '],
            ['name' => 'partners_franchising', 'label' => 'Sócios '],
            ['name' => 'collaborators_franchising', 'label' => 'Colaboradores '],
            ['name' => 'import_franchising', 'label' => 'Importar '],
            ['name' => 'export_franchising', 'label' => 'Exportar '],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Cadastro - Sócios']);

        $permissions = [
            ['name' => 'add_partner', 'label' => 'Adicionar'],
            ['name' => 'edit_partner', 'label' => 'Editar'],
            ['name' => 'view_partner', 'label' => 'Visualizar'],
            ['name' => 'delete_partner', 'label' => 'Deletar'],
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
            ['name' => 'add_type_sales', 'label' => 'Adicionar'],
            ['name' => 'edit_type_sales', 'label' => 'Editar'],
            ['name' => 'view_type_sales', 'label' => 'Visualizar'],
            ['name' => 'delete_type_sales', 'label' => 'Deletar'],
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
            ['name' => 'add_type_termination', 'label' => 'Adicionar'],
            ['name' => 'edit_type_termination', 'label' => 'Editar'],
            ['name' => 'view_type_termination', 'label' => 'Visualizar'],
            ['name' => 'delete_type_termination', 'label' => 'Deletar'],
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
            ['name' => 'add_type_status_charges', 'label' => 'Adicionar'],
            ['name' => 'edit_type_status_charges', 'label' => 'Editar'],
            ['name' => 'view_type_status_charges', 'label' => 'Visualizar'],
            ['name' => 'delete_type_status_charges', 'label' => 'Deletar'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Cadastro - Juros dos Lançamentos']);

        $permissions = [
            ['name' => 'add_fees', 'label' => 'Adicionar'],
            ['name' => 'edit_fees', 'label' => 'Editar'],
            ['name' => 'view_fees', 'label' => 'Visualizar'],
            ['name' => 'delete_fees', 'label' => 'Deletar'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Permissões - Lançamentos']);

        $permissions = [
            ['name' => 'add_releases', 'label' => 'Adicionar'],
            ['name' => 'edit_releases', 'label' => 'Editar'],
            ['name' => 'view_releases', 'label' => 'Visualizar'],
            ['name' => 'delete_releases', 'label' => 'Deletar '],
            ['name' => 'import_releases', 'label' => 'Importar '],
            ['name' => 'export_releases', 'label' => 'Exportar '],
            ['name' => 'export_releases_historics', 'label' => 'Históricos '],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Permissões - Acordos']);

        $permissions = [
            ['name' => 'add_agreement', 'label' => 'Adicionar'],
            ['name' => 'edit_agreement', 'label' => 'Editar'],
            ['name' => 'view_agreement', 'label' => 'Visualizar'],
            ['name' => 'delete_agreement', 'label' => 'Deletar '],
            ['name' => 'view_agreement_all', 'label' => 'Visualizar Todos'],
            ['name' => 'view_agreement_user', 'label' => 'Visualizar Somente Usuário'],
            ['name' => 'export_word_agreement', 'label' => ' Exportar Word '],
            ['name' => 'export_pdf_agreement', 'label' => ' Exportar PDF ']
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }


        $group = GroupPermissions::create(['name' => 'Permissões - Cobranças']);

        $permissions = [
            ['name' => 'view_charges', 'label' => 'Visualizar'],
            ['name' => 'view_charges_user', 'label' => 'Visualizar Somente Usuário'],
            ['name' => 'view_charges_all', 'label' => 'Visualizar Todos'],
            ['name' => 'change_status_charges', 'label' => 'Alterar Status Cobrança'],
            ['name' => 'view_franchising_charges', 'label' => 'Visualizar dados Franqueado'],
            ['name' => 'edit_franchising_charges', 'label' => 'Editar dados Franqueado'],
            ['name' => 'view_precification_charges', 'label' => 'Vizualizar Precificação de Valores'],
            ['name' => 'change_precification_charges', 'label' => 'Editar Precificação de Valores'],
            ['name' => 'view_releases_charges', 'label' => 'Vizualizar Lançamentos'],
            ['name' => 'add_historic_charges', 'label' => 'Cadastrar Cobranças'],
            ['name' => 'view_historic_charges', 'label' => 'Vizualizar Historicos'],
            ['name' => 'view_proposal_charges', 'label' => 'Vizualizar Propostas'],
            ['name' => 'details_proposal_charges', 'label' => 'Detalhes Proposta Especifica'],
            ['name' => 'add_proposal_charges', 'label' => 'Adicionar Propostas'],
            ['name' => 'block_proposal_charges', 'label' => 'Ativar/Bloquear Propostas'],
            ['name' => 'delete_proposal_charges', 'label' => 'Apagar Propostas'],
            ['name' => 'whatsapp_proposal_charges', 'label' => 'Enviar WhatsApp de Propostas'],
            ['name' => 'send_email_proposal_charges', 'label' => 'Enviar email de Propostas'],
            ['name' => 'view_proposal_accept_charges', 'label' => 'Vizualizar Termo de Aceite'],
            ['name' => 'details_proposal_accept_charges', 'label' => 'Detalhes Termo de Aceite'],
            ['name' => 'add_proposal_accept_charges', 'label' => 'Adicionar Termo de Aceite'],
            ['name' => 'block_proposal_accept_charges', 'label' => 'Ativar/Bloquear Termo de Aceite'],
            ['name' => 'delete_proposal_accept_charges', 'label' => 'Deletar Termo de Aceite'],
            ['name' => 'send_email_proposal_accept_charges', 'label' => 'Envia email de Termo de Aceite'],
            ['name' => 'simulation_charges', 'label' => 'Simulação de Acordos'],

        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Relatórios - Histórico Cobrança']);

        $permissions = [
            ['name' => 'view_report_charges', 'label' => 'Visualizar'],
            ['name' => 'export_report_charges', 'label' => 'Exportar'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Relatórios - Lançamentos']);

        $permissions = [
            ['name' => 'view_report_releases', 'label' => 'Visualizar'],
            ['name' => 'export_report_releases', 'label' => 'Exportar'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Relatórios - Acordos']);

        $permissions = [
            ['name' => 'view_report_agreements', 'label' => 'Visualizar'],
            ['name' => 'export_report_agreements', 'label' => 'Exportar'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }


//        // create permissions
//        Permission::create(['name' => 'edit articles']);
//        Permission::create(['name' => 'delete articles']);
//        Permission::create(['name' => 'publish articles']);
//        Permission::create(['name' => 'unpublish articles']);
//
//        // create roles and assign existing permissions
//        $role1 = Role::create(['name' => 'writer', 'tenant_id'  => 1]);
//        $role1->givePermissionTo('edit articles');
//        $role1->givePermissionTo('delete articles');

    }
}
