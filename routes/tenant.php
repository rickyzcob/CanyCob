<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailsChargesCrontroller;
use App\Http\Controllers\ProposalChargesController;
use App\Http\Controllers\PorposalFormalizedController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AgreementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//dd(session('tenant'));
Route::domain('{subdomain}.' . env('APP_URL'))->group(function ($router) {

    Route::view('/login', 'tenant.auth.login')->name('login');
    Route::view('/recuperar-senha', 'tenant.auth.recovery')->middleware('guest')->name('password.request');
    Route::view('/resetar-senha', 'tenant.auth.reset')->middleware('guest')->name('password.reset');

    Route::middleware(['auth'])->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->middleware('permission:tenant_dashboard_view')->name('dashboard.index');
        Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('permission:tenant_dashboard_view')->name('dashboard.index');

        Route::view('cadastros/lancamentos', 'tenant.releases.index')->middleware('permission:tenant_view_releases')->name('releases.index');
        Route::view('cadastros/franqueados', 'tenant.franchising.index')->middleware('permission:tenant_view_franchising')->name('franchising.index');
        Route::view('cadastros/socios', 'tenant.partners.index')->middleware('permission:tenant_view_partner')->name('partners.index');
        Route::view('cadastros/statusdecobranca', 'tenant.chargestatuses.index')->middleware('permission:tenant_view_fees')->name('chargestatuses.index');
        Route::view('cadastros/juros', 'tenant.fees.index')->middleware('permission:tenant_view_fees')->name('fees.index');

        Route::view('/cobrancas', 'tenant.charges.index')->middleware('permission:tenant_view_charges')->name('charges.index');
        Route::get('/cobrancas/{reference}/detalhes', [DetailsChargesCrontroller::class, 'show'])->middleware('permission:tenant_details_charges')->name('charges.show');

        Route::view('/agenda', 'tenant.schedule.index')->middleware('permission:tenant_view_schedule')->name('schedule.index');

        Route::view('/acordos', 'tenant.agreement.index')->middleware('permission:tenant_view_agreement')->name('agreement.index');
        Route::get('/acordos/{reference}/vizualizar', [AgreementController::class, 'show'])->middleware('permission:tenant_view_details_agreement')->name('agreement.show');

        Route::view('humor', 'tenant.humor.index')->middleware('permission:tenant_view_humor')->name('humor.index');

        Route::view('configuracoes/usuarios', 'tenant.user.index')->middleware('permission:tenant_view_user')->name('user.index');
        Route::view('configuracoes/permissoes', 'tenant.permissions.index')->middleware('permission:tenant_view_permission')->name('permissions.index');
        Route::view('configuracoes/layout', 'tenant.layout.index')->middleware('permission:tenant_view_configuration')->name('layout.index');
        Route::view('configuracoes/parametros', 'tenant.configuration.index')->middleware('permission:tenant_view_configuration_params')->name('configuration.index');
        Route::view('configuracoes/ranking', 'tenant.ranking.index')->middleware('permission:tenant_view_ranking')->name('ranking.index');

        Route::view('relatorios/cobranca', 'tenant.report.charges.index')->middleware('permission:tenant_view_report_charges')->name('report.charges.index');
        Route::view('relatorios/lancamentos', 'tenant.report.releases.index')->middleware('permission:tenant_view_report_releases')->name('report.releases.index');
        Route::view('relatorios/acordos', 'tenant.report.agreements.index')->middleware('permission:tenant_view_report_agreements')->name('report.agreements.index');
        Route::view('relatorios/humor', 'tenant.report.humor.index')->middleware('permission:tenant_view_report_humor')->name('report.humor.index');


        Route::view('notificacoes', 'tenant.notifications.index')->name('notifications.index');


        Route::view('meu-perfil', 'tenant.profile.index')->name('profile.index');

        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    });

    Route::get('/proposta/{reference}/vizualizar', [ProposalChargesController::class, 'show'])->name('proposal.show');
    Route::get('/formalizar/{reference}/vizualizar', [PorposalFormalizedController::class, 'show'])->name('formalized.show');
    Route::view('frontend', 'frontend.index')->name('notifications.index');
});


//Route::group(array('domain' => '{subdomain}.' . env('APP_URL')), function()
//{
//    Route::get('posts', function () {
//        return 'Rotas para o escopo Integrador, {subdomain}';
//    });
//});
