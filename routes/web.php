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

Route::view('/', 'auth.login')->name('login');
Route::view('/recuperar-senha', 'auth.recovery')->middleware('guest')->name('password.request');
Route::view('/resetar-senha', 'auth.reset')->middleware('guest')->name('password.reset');

Route::middleware(['auth'])->group(function () {



//Route::view('/dashboard', 'dashboard.index')->name('dashboard.index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::view('/lancamentos', 'releases.index')->name('releases.index');

Route::view('cadastros/franqueados', 'franchising.index')->name('franchising.index');
Route::view('cadastros/socios', 'partners.index')->name('partners.index');
Route::view('cadastros/statusdecobranca', 'chargestatuses.index')->name('chargestatuses.index');
Route::view('cadastros/juros', 'fees.index')->middleware('permission:view_fees')->name('fees.index');

Route::view('/cobrancas', 'charges.index')->name('charges.index');
Route::view('/acordos', 'agreement.index')->name('agreement.index');
Route::get('/acordos/{reference}/vizualizar', [AgreementController::class, 'show'])->name('agreement.show');

Route::get('/cobrancas/{reference}/detalhes', [DetailsChargesCrontroller::class, 'show'])->name('charges.show');

Route::view('configuracoes/usuarios', 'user.index')->name('user.index');
Route::view('configuracoes/permissoes', 'permissions.index')->name('permissions.index');

Route::view('relatorios/cobranca', 'report.charges.index')->name('report.charges.index');
Route::view('relatorios/lancamentos', 'report.releases.index')->name('report.releases.index');
Route::view('relatorios/acordos', 'report.agreements.index')->name('report.agreements.index');

Route::view('notificacoes', 'notifications.index')->name('notifications.index');

Route::view('meu-perfil', 'profile.index')->name('profile.index');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

});

Route::view('/frontend', 'frontend.index')->name('frontend.index');

Route::get('/proposta/{reference}/vizualizar', [ProposalChargesController::class, 'show'])->name('proposal.show');
Route::get('/formalizar/{reference}/vizualizar', [PorposalFormalizedController::class, 'show'])->name('formalized.show');

//Route::get('/fire', function () {
//    \App\Events\ProposalAccept::dispatch("chegou a porra da mensagem!!");
//    return "fired";
//});
