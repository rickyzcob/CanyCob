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

        $group = GroupPermissions::create(['name' => 'Dashboard']);

        $permissions = [
            ['name' => 'tenant_dashboard_view', 'label' => 'Visualizar Dashboard'],
            ['name' => 'tenant_dashboard_view_panel', 'label' => 'Visualizar Painel Informativo'],
            ['name' => 'tenant_dashboard_view_panel_all', 'label' => 'Painel Informativo dados geral'],
            ['name' => 'tenant_dashboard_view_panel_user', 'label' => 'Painel Informativo dados usuários'],
            ['name' => 'tenant_dashboard_view_agreement', 'label' => 'Visualizar acordos'],
            ['name' => 'tenant_dashboard_view_graph', 'label' => 'Visualizar Graficos'],
            ['name' => 'tenant_dashboard_view_ranking', 'label' => 'Visualizar Ranking'],
            ['name' => 'tenant_dashboard_view_panel_charges', 'label' => 'Painel Cobranças'],
            ['name' => 'tenant_dashboard_view_charge', 'label' => 'Visualizar Cobranças '],
            ['name' => 'tenant_dashboard_view_conference', 'label' => 'Visualizar conferencias '],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Configurações - Cadastro de Usuários']);

        $permissions = [
            ['name' => 'tenant_add_user', 'label' => 'Adicionar'],
            ['name' => 'tenant_edit_user', 'label' => 'Editar'],
            ['name' => 'tenant_view_user', 'label' => 'Visualizar'],
            ['name' => 'tenant_delete_user', 'label' => 'Deletar ']
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
            ['name' => 'tenant_add_permission', 'label' => 'Adicionar'],
            ['name' => 'tenant_edit_permission', 'label' => 'Editar'],
            ['name' => 'tenant_view_permission', 'label' => 'Visualizar'],
            ['name' => 'tenant_delete_permission', 'label' => 'Deletar'],
            ['name' => 'tenant_roles_permission', 'label' => 'Permissões'],
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
            ['name' => 'tenant_edit_configuration_color', 'label' => 'Editar Cor'],
            ['name' => 'tenant_edit_configuration_logo', 'label' => 'Editar Logotipo'],
            ['name' => 'tenant_view_configuration', 'label' => 'Visualizar'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Configurações - Parametros']);

        $permissions = [

            ['name' => 'tenant_edit_configuration_params', 'label' => 'Editar'],
            ['name' => 'tenant_view_configuration_params', 'label' => 'Visualizar'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Configurações - Ranking']);

        $permissions = [

            ['name' => 'tenant_reset_ranking', 'label' => 'Resetar Ranking'],
            ['name' => 'tenant_view_ranking', 'label' => 'Visualizar'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Permissões - Humor']);

        $permissions = [

            ['name' => 'tenant_view_humor', 'label' => 'Visualizar'],
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
            ['name' => 'tenant_add_franchising', 'label' => 'Adicionar'],
            ['name' => 'tenant_edit_franchising', 'label' => 'Editar'],
            ['name' => 'tenant_view_franchising', 'label' => 'Visualizar'],
            ['name' => 'tenant_delete_franchising', 'label' => 'Deletar '],
            ['name' => 'tenant_partners_franchising', 'label' => 'Sócios '],
            ['name' => 'tenant_collaborators_franchising', 'label' => 'Colaboradores '],
            ['name' => 'tenant_import_franchising', 'label' => 'Importar '],
            ['name' => 'tenant_export_franchising', 'label' => 'Exportar '],
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
            ['name' => 'tenant_add_partner', 'label' => 'Adicionar'],
            ['name' => 'tenant_edit_partner', 'label' => 'Editar'],
            ['name' => 'tenant_view_partner', 'label' => 'Visualizar'],
            ['name' => 'tenant_delete_partner', 'label' => 'Deletar'],
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
            ['name' => 'tenant_add_fees', 'label' => 'Adicionar'],
            ['name' => 'tenant_edit_fees', 'label' => 'Editar'],
            ['name' => 'tenant_view_fees', 'label' => 'Visualizar'],
            ['name' => 'tenant_delete_fees', 'label' => 'Deletar'],
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
            ['name' => 'tenant_add_releases', 'label' => 'Adicionar'],
            ['name' => 'tenant_edit_releases', 'label' => 'Editar'],
            ['name' => 'tenant_view_releases', 'label' => 'Visualizar'],
            ['name' => 'tenant_delete_releases', 'label' => 'Deletar '],
            ['name' => 'tenant_import_releases', 'label' => 'Importar '],
            ['name' => 'tenant_export_releases', 'label' => 'Exportar '],
            ['name' => 'tenant_export_releases_historics', 'label' => 'Históricos '],
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
            ['name' => 'tenant_add_agreement', 'label' => 'Adicionar'],
            ['name' => 'tenant_edit_agreement', 'label' => 'Editar'],
            ['name' => 'tenant_view_agreement', 'label' => 'Visualizar'],
            ['name' => 'tenant_delete_agreement', 'label' => 'Deletar '],
            ['name' => 'tenant_view_agreement_all', 'label' => 'Visualizar Todos'],
            ['name' => 'tenant_view_agreement_user', 'label' => 'Visualizar Somente Usuário'],
            ['name' => 'tenant_view_contract_agreement', 'label' => 'Visualizar Contrato'],
            ['name' => 'tenant_view_releases_agreement', 'label' => 'Ver lançamentos'],
            ['name' => 'tenant_view_details_agreement', 'label' => 'Ver detalhes'],
            ['name' => 'tenant_create_term_agreement', 'label' => 'Criar Confissão Divida'],
            ['name' => 'tenant_send_term_agreement', 'label' => 'Enviar Confissão Divida'],
            ['name' => 'tenant_download_term_agreement', 'label' => 'Baixar Confissão Divida'],
            ['name' => 'tenant_export_word_agreement', 'label' => ' Exportar Word '],
            ['name' => 'tenant_export_pdf_agreement', 'label' => ' Exportar PDF '],
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
            ['name' => 'tenant_view_charges', 'label' => 'Visualizar'],
            ['name' => 'tenant_view_charges_user', 'label' => 'Visualizar Somente Usuário'],
            ['name' => 'tenant_view_charges_all', 'label' => 'Visualizar Todos'],
            ['name' => 'tenant_change_status_charges', 'label' => 'Alterar Status Cobrança'],
            ['name' => 'tenant_view_franchising_charges', 'label' => 'Visualizar dados Franqueado'],
            ['name' => 'tenant_edit_franchising_charges', 'label' => 'Editar dados Franqueado'],
            ['name' => 'tenant_view_precification_charges', 'label' => 'Vizualizar Precificação de Valores'],
            ['name' => 'tenant_change_precification_charges', 'label' => 'Editar Precificação de Valores'],
            ['name' => 'tenant_view_releases_charges', 'label' => 'Vizualizar Lançamentos'],
            ['name' => 'tenant_add_historic_charges', 'label' => 'Cadastrar Cobranças'],
            ['name' => 'tenant_view_historic_charges', 'label' => 'Vizualizar Historicos'],
            ['name' => 'tenant_view_proposal_charges', 'label' => 'Vizualizar Propostas'],
            ['name' => 'tenant_details_proposal_charges', 'label' => 'Detalhes Proposta Especifica'],
            ['name' => 'tenant_add_proposal_charges', 'label' => 'Adicionar Propostas'],
            ['name' => 'tenant_block_proposal_charges', 'label' => 'Ativar/Bloquear Propostas'],
            ['name' => 'tenant_delete_proposal_charges', 'label' => 'Apagar Propostas'],
            ['name' => 'tenant_whatsapp_proposal_charges', 'label' => 'Enviar WhatsApp de Propostas'],
            ['name' => 'tenant_send_email_proposal_charges', 'label' => 'Enviar email de Propostas'],
            ['name' => 'tenant_view_proposal_accept_charges', 'label' => 'Vizualizar Termo de Aceite'],
            ['name' => 'tenant_details_proposal_accept_charges', 'label' => 'Detalhes Termo de Aceite'],
            ['name' => 'tenant_add_proposal_accept_charges', 'label' => 'Adicionar Termo de Aceite'],
            ['name' => 'tenant_block_proposal_accept_charges', 'label' => 'Ativar/Bloquear Termo de Aceite'],
            ['name' => 'tenant_delete_proposal_accept_charges', 'label' => 'Deletar Termo de Aceite'],
            ['name' => 'tenant_send_email_proposal_accept_charges', 'label' => 'Envia email de Termo de Aceite'],
            ['name' => 'tenant_simulation_charges', 'label' => 'Simulação de Acordos'],
            ['name' => 'tenant_details_charges', 'label' => 'Vizualizar Detalhes da Cobrança'],

        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Permissões - Agenda']);

        $permissions = [
            ['name' => 'tenant_add_schedule', 'label' => 'Adicionar'],
            ['name' => 'tenant_edit_schedule', 'label' => 'Editar'],
            ['name' => 'tenant_view_schedule', 'label' => 'Visualizar'],
            ['name' => 'tenant_delete_schedule', 'label' => 'Deletar '],
            ['name' => 'tenant_view_aschedule_all', 'label' => 'Visualizar Todos'],
            ['name' => 'tenant_view_aschedule_user', 'label' => 'Visualizar Somente Usuário'],
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
            ['name' => 'tenant_view_report_charges', 'label' => 'Visualizar'],
            ['name' => 'tenant_export_report_charges', 'label' => 'Exportar'],
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
            ['name' => 'tenant_view_report_releases', 'label' => 'Visualizar'],
            ['name' => 'tenant_export_report_releases', 'label' => 'Exportar'],
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
            ['name' => 'tenant_view_report_agreements', 'label' => 'Visualizar'],
            ['name' => 'tenant_export_report_agreements', 'label' => 'Exportar'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }

        $group = GroupPermissions::create(['name' => 'Relatórios - Humor']);

        $permissions = [
            ['name' => 'tenant_view_report_humor', 'label' => 'Visualizar'],
            ['name' => 'tenant_export_report_humor', 'label' => 'Exportar'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group_permissions_id' => $group->id,
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);
        }


//        // create permissions
//        Permission::create(['name' => 'tenant_edit articles']);
//        Permission::create(['name' => 'tenant_delete articles']);
//        Permission::create(['name' => 'tenant_publish articles']);
//        Permission::create(['name' => 'tenant_unpublish articles']);
//
//        // create roles and assign existing permissions
//        $role1 = Role::create(['name' => 'tenant_writer', 'tenant_id'  => 1]);
//        $role1->givePermissionTo('edit articles');
//        $role1->givePermissionTo('delete articles');

    }
}
