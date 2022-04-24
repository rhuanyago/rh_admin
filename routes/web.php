<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TesteController;

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

// Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('login', [AuthController::class, 'login'])->name('login.do');
// Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('home', function () {
//     return view('welcome');
// })->name('home');
Auth::routes();

Route::get('/teste', [TesteController::class, 'index'])->name('teste');

Route::controller(HomeController::class)->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// Route::controller(ClientController::class)->group(function () {
//     Route::get('/clients', 'index')->name('clients.home');
//     Route::get('/clients/{id}', 'show')->name('clients.store');
//     Route::post('/clients', 'store');
// });

Route::resource('clients', ClientController::class);
Route::get('ajaxClients', [ClientController::class, 'listClients'])->name('listClients');

// Route::resource('users', UserController::class);