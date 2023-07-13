<?php

namespace App\Repositories\Permissions;

class GivePermissionsByCharge
{
    public function permissionsCharge()
    {
        $permmissions = [
            'tenant_dashboard_view',
            'tenant_dashboard_view_panel',
            'tenant_dashboard_view_panel_user',
            'tenant_dashboard_view_agreement',
            'tenant_dashboard_view_graph',
            'tenant_dashboard_view_ranking',
            'tenant_dashboard_view_panel_charges',
            'tenant_dashboard_view_charge',
            'tenant_dashboard_view_conference',
            'tenant_edit_franchising',
            'tenant_view_franchising',
            'tenant_delete_franchising',
            'tenant_partners_franchising',
            'tenant_collaborators_franchising',
            'tenant_import_franchising',
            'tenant_add_partner',
            'tenant_edit_partner',
            'tenant_view_partner',
            'tenant_delete_partner',
            'tenant_edit_releases',
            'tenant_view_releases',
            'tenant_delete_releases',
            'tenant_import_releases',
            'tenant_export_releases',
            'tenant_view_agreement',
            'tenant_view_agreement_user',
            'tenant_view_contract_agreement',
            'tenant_view_releases_agreement',
            'tenant_view_details_agreement',
            'tenant_view_charges',
            'tenant_view_charges_user',
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
        ];

        return $permmissions;

    }

}
