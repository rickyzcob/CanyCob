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

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::view('cadastros/lancamentos', 'tenant.releases.index')->name('releases.index');
        Route::view('cadastros/franqueados', 'tenant.franchising.index')->name('franchising.index');
        Route::view('cadastros/socios', 'tenant.partners.index')->name('partners.index');
        Route::view('cadastros/statusdecobranca', 'tenant.chargestatuses.index')->name('chargestatuses.index');
        Route::view('cadastros/juros', 'tenant.fees.index')->middleware('permission:view_fees')->name('fees.index');

        Route::view('/cobrancas', 'tenant.charges.index')->name('charges.index');
        Route::view('/acordos', 'tenant.agreement.index')->name('agreement.index');
        Route::get('/acordos/{reference}/vizualizar', [AgreementController::class, 'show'])->name('agreement.show');

//        Route::get('/cobrancas/detalhes', function ($reference) {
//            return 'Post ' . $reference . ' in second subdomain';
//        })->name('charges.show');

        Route::get('/cobrancas/{reference}/detalhes', [DetailsChargesCrontroller::class, 'show'])->name('charges.show');

        Route::view('configuracoes/usuarios', 'tenant.user.index')->name('user.index');
        Route::view('configuracoes/permissoes', 'tenant.permissions.index')->name('permissions.index');
        Route::view('configuracoes/geral', 'tenant.configuration.index')->name('configuration.index');

        Route::view('relatorios/cobranca', 'tenant.report.charges.index')->name('report.charges.index');
        Route::view('relatorios/lancamentos', 'tenant.report.releases.index')->name('report.releases.index');
        Route::view('relatorios/acordos', 'tenant.report.agreements.index')->name('report.agreements.index');
        Route::view('relatorios/humor', 'tenant.report.humor.index')->name('report.humor.index');
        Route::view('humor', 'tenant.humor.index')->name('humor.index');

        Route::view('notificacoes', 'tenant.notifications.index')->name('notifications.index');

        Route::view('meu-perfil', 'tenant.profile.index')->name('profile.index');

        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    });

    Route::get('/proposta/{reference}/vizualizar', [ProposalChargesController::class, 'show'])->name('proposal.show');
    Route::get('/formalizar/{reference}/vizualizar', [PorposalFormalizedController::class, 'show'])->name('formalized.show');

});


//Route::group(array('domain' => '{subdomain}.' . env('APP_URL')), function()
//{
//    Route::get('posts', function () {
//        return 'Rotas para o escopo Integrador, {subdomain}';
//    });
//});
