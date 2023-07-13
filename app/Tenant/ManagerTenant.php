<?php

namespace App\Tenant;

use App\Models\Tenant;

class ManagerTenant
{
    public function subdomain()
    {
        $piecesHost = explode('.', request()->getHost());
        return $piecesHost[0];
    }

    public function tenant()
    {
        $subdomain = $this->subdomain();
        $tenant = Tenant::where('subdomain', $subdomain)->where('status', 'Ativo')->first();

        if(!$tenant){
            return abort(404);
        }
        return $tenant;
}
    public function getTenantIdentify()
    {
        return auth()->user()->tenant->id;
    }

    public function identify()
    {
        $tenant = $this->tenant();
        return $tenant;
    }

    public function isSubdomainAdmin()
    {
        $subdomain = $this->subdomain();
        $subdomainAdmin = config('tenant.subdomain_admin');

        return $subdomain == $subdomainAdmin;

    }
    public function checkScope()
    {
        $subdomain = $this->subdomain();
        $subdomainTeam = config('tenant.subdomain_admin');
        $subdomainCommercial = config('tenant.subdomain_commercial');

        if($subdomain != $subdomainTeam || $subdomain != $subdomainCommercial){
            return $subdomain;
        }
    }

}
