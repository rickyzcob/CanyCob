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

        $model->setAttribute('tenant_id', $tenantReturn);
    }
}
