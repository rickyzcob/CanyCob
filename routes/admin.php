<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. Theses
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/login', 'admin.auth.login')->name('login');
Route::view('/recuperar-senha', 'admin.auth.recovery')->middleware('guest')->name('password.request');
Route::view('/resetar-senha', 'admin.auth.reset')->middleware('guest')->name('password.reset');

Route::middleware(['auth'])->group(function () {

    Route::view('/dashboard', 'admin.dashboard.index')->name('admin.dashboard.index');

    Route::view('/clientes', 'admin.clients.index')->name('tenant.index');

    Route::view('notificacoes', 'adminc.notifications.index')->name('notifications.index');

    Route::view('meu-perfil', 'admin.profile.index')->name('profile.index');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

});


