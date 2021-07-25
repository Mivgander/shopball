<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KategoriaController;
use App\Http\Controllers\ProduktController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\RedirectResponse;

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

Route::get('/', [IndexController::class, 'show']);
Route::get('kategoria/{nazwa}', [KategoriaController::class, 'show'])->name('kategorie');
Route::get('produkt/{nazwa}/{id}', [ProduktController::class, 'show']);

/* LOGOWANIE */
Route::get('login', [LoginController::class, 'main']);
Route::post('login', [LoginController::class, 'login']);
/* LOGOWANIE */

/* WYLOGOWYWANIE */
Route::get('wyloguj', [LoginController::class, 'wyloguj']);
/* WYLOGOWYWANIE */

/* REJESTRACJA */
Route::get('register', [RegisterController::class, 'main']);
Route::post('register', [RegisterController::class, 'register']);
/* REJESTRACJA */
