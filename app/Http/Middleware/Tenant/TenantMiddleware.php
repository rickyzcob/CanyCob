<?php

namespace App\Http\Middleware\Tenant;

use App\Tenant\ManagerTenant;
use Closure;
use Illuminate\Http\Request;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $tenantReturn = new ManagerTenant();
        $tenant = $tenantReturn->tenant();

        if(!$tenant){
            return abort(404);
        }

        $this->setSession($tenant->only('name', 'subdomain', 'color', 'text_color', 'scope', 'logo'));

        return $next($request);
    }

    public function setSession($tenant)
    {
        session()->put('tenant', $tenant);

    }
}
