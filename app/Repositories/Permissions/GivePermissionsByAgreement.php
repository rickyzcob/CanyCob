<?php

namespace App\Repositories\Permissions;

class GivePermissionsByAgreement
{
    public function permissionsAgreement()
    {
        $permmissions = [

            'tenant_dashboard_view',
            'tenant_dashboard_view_panel',
            'tenant_dashboard_view_panel_all',
            'tenant_dashboard_view_agreement',
            'tenant_dashboard_view_graph',
            'tenant_dashboard_view_ranking',
            'tenant_add_franchising',
            'tenant_edit_franchising',
            'tenant_view_franchising',
            'tenant_delete_franchising',
            'tenant_partners_franchising',
            'tenant_collaborators_franchising',
            'tenant_import_franchising',
            'tenant_export_franchising',
            'tenant_add_releases',
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
            'tenant_details_charges',
            'tenant_view_charges',
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
        ];

        return $permmissions;

    }

}
