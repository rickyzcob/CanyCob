<?php

namespace App\Repositories\Permissions;

use Spatie\Permission\Models\Role;

class GivePermissionsByRole
{
    public function givePermissionsAdministrator($id = null)
    {
        $role = Role::query()->findOrFail($id);
        $role->syncPermissions($this->permissionsAdministrator());
    }

    public function permissionsAdministrator()
    {
        $permmissions = ['tenant_add_user',
            'tenant_edit_user',
            'tenant_view_user',
            'tenant_delete_user',
            'tenant_add_permission',
            'tenant_edit_permission',
            'tenant_view_permission',
            'tenant_delete_permission',
            'tenant_roles_permission',
            'tenant_add_configuration',
            'tenant_edit_configuration',
            'tenant_view_configuration',
            'tenant_delete_configuration',
            'tenant_add_franchising',
            'tenant_edit_franchising',
            'tenant_view_franchising',
            'tenant_delete_franchising',
            'tenant_partners_franchising',
            'tenant_collaborators_franchising',
            'tenant_import_franchising',
            'tenant_export_franchising',
            'tenant_add_partner',
            'tenant_edit_partner',
            'tenant_view_partner',
            'tenant_delete_partner',
            'tenant_add_type_sales',
            'tenant_edit_type_sales',
            'tenant_view_type_sales',
            'tenant_delete_type_sales',
            'tenant_add_type_termination',
            'tenant_edit_type_termination',
            'tenant_view_type_termination',
            'tenant_delete_type_termination',
            'tenant_add_type_status_charges',
            'tenant_edit_type_status_charges',
            'tenant_view_type_status_charges',
            'tenant_delete_type_status_charges',
            'tenant_add_fees',
            'tenant_edit_fees',
            'tenant_view_fees',
            'tenant_delete_fees',
            'tenant_add_releases',
            'tenant_edit_releases',
            'tenant_view_releases',
            'tenant_delete_releases',
            'tenant_import_releases',
            'tenant_export_releases',
            'tenant_export_releases_historics',
            'tenant_add_agreement',
            'tenant_edit_agreement',
            'tenant_view_agreement',
            'tenant_delete_agreement',
            'tenant_view_agreement_all',
            'tenant_view_agreement_user',
            'tenant_view_contract_agreement',
            'tenant_view_releases_agreement',
            'tenant_view_details_agreement',
            'tenant_create_term_agreement',
            'tenant_send_term_agreement',
            'tenant_download_term_agreement',
            'tenant_export_word_agreement',
            'tenant_export_pdf_agreement',
            'tenant_view_charges',
            'tenant_view_charges_user',
            'tenant_view_charges_all',
            'tenant_change_status_charges',
            'tenant_view_franchising_charges',
            'tenant_edit_franchising_charges',
            'tenant_view_precification_charges',
            'tenant_change_precification_charges',
            'tenant_view_releases_charges',
            'tenant_add_historic_charges',
            'tenant_view_historic_charges',
            'tenant_view_proposal_charges',
            'tenant_details_proposal_charges',
            'tenant_add_proposal_charges',
            'tenant_block_proposal_charges',
            'tenant_delete_proposal_charges',
            'tenant_whatsapp_proposal_charges',
            'tenant_send_email_proposal_charges',
            'tenant_view_proposal_accept_charges',
            'tenant_details_proposal_accept_charges',
            'tenant_add_proposal_accept_charges',
            'tenant_block_proposal_accept_charges',
            'tenant_delete_proposal_accept_charges',
            'tenant_send_email_proposal_accept_charges',
            'tenant_simulation_charges',
            'tenant_add_humor',
            'tenant_edit_humor',
            'tenant_view_humor',
            'tenant_delete_humor',
            'tenant_view_report_charges',
            'tenant_export_report_charges',
            'tenant_view_report_releases',
            'tenant_export_report_releases',
            'tenant_view_report_agreements',
            'tenant_export_report_agreements',
            'tenant_view_report_humor',
            'tenant_export_report_humor'];

        return $permmissions;

    }
}




