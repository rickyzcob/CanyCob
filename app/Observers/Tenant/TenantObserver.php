<?php

namespace App\Observers\Tenant;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

class TenantObserver
{
    public function creating(Model $model)
    {
        $tenant = new ManagerTenant();
        $tenantReturn = $tenant->identify();

        if($tenantReturn->scope == 'Cliente'){
            $model->setAttribute('tenant_id', $tenantReturn->id);
        }
    }
}
