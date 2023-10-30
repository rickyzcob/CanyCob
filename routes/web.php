<?php


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

Route::view('/home', 'site.home.index')->name('home.index');
Route::view('/sobre-nos', 'site.about.index')->name('about.index');
Route::view('/servicos', 'site.services.index')->name('services.index');
Route::view('/blog', 'site.blog.index')->name('blog.index');
Route::view('/planos', 'site.plans.index')->name('plans.index');
Route::view('/ajuda', 'site.support.index')->name('support.index');
Route::view('/contato', 'site.contact.index')->name('contact.index');
