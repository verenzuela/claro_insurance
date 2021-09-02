<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Auth::routes();

Route::get('/', [LoginController::class, 'showLoginForm'])->name('index.page');
Route::get('/create/user', [UserController::class, 'createNewUser'])->name('create.user');
Route::post('/create/user', [UserController::class, 'storeNewUser'])->name('store.user');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/country/{country_id}/states', [StateController::class, 'getStatesByCountry'])->name('getStatesByCountry');
Route::get('/state/{state_id}/city', [CityController::class, 'getCitiesByState'])->name('getCitiesByState');

Route::group(['middleware' => 'auth'], function () {
    Route::post('users-data/action', [UserController::class, 'action'])->name('users-data.action');
    
    Route::post('home', [HomeController::class, 'index'])->name('search.by.text');

    Route::get('audit', [AuditController::class, 'index'])->name('audit.index');

    Route::get('emails', [EmailController::class, 'index'])->name('email.index');
    Route::get('email/create', [EmailController::class, 'create'])->name('email.create');
    Route::post('email/send', [EmailController::class, 'send'])->name('email.send');
});

