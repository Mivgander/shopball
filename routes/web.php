<?php

use App\Http\Controllers\DodajController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KategoriaController;
use App\Http\Controllers\KontoController;
use App\Http\Controllers\KoszykController;
use App\Http\Controllers\ProduktController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SzukajController;
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

Route::get('/', [IndexController::class, 'show'])->name('index');
Route::get('kategoria/{nazwa}', [KategoriaController::class, 'show'])->name('kategorie');
Route::get('produkt/{nazwa}/{id}', [ProduktController::class, 'show']);
Route::get('szukaj', [SzukajController::class, 'main']);

/* KONTO */
Route::get('konto', [KontoController::class, 'main'])->middleware('auth');
Route::post('konto/zmien/nick', [KontoController::class, 'nick'])->middleware('auth');
Route::post('konto/zmien/email', [KontoController::class, 'email'])->middleware('auth');
Route::post('konto/zmien/haslo', [KontoController::class, 'haslo'])->middleware('auth');
/* KONTO */

/* INFO */
Route::get('o-nas', function(){
    return view('o-nas');
});
Route::get('o-produktach', function(){
    return view('o-produktach');
});
/* INFO */

/* DODAWANIE */
Route::get('dodaj', [DodajController::class, 'main'])->middleware(['admin', 'auth']);
Route::get('dodaj/pomyslnie', [DodajController::class, 'pomyslnie'])->middleware(['auth', 'admin']);
/* DODAWANIE */

/* LOGOWANIE */
Route::get('login', [LoginController::class, 'main'])->name('login');
Route::post('login', [LoginController::class, 'login']);
/* LOGOWANIE */

/* WYLOGOWYWANIE */
Route::get('wyloguj', [LoginController::class, 'wyloguj']);
/* WYLOGOWYWANIE */

/* REJESTRACJA */
Route::get('register', [RegisterController::class, 'main']);
Route::post('register', [RegisterController::class, 'register']);
/* REJESTRACJA */

/* KOSZYK */
Route::get('koszyk', [KoszykController::class, 'main'])->middleware('auth');
Route::get('koszyk/dodaj/{nazwa}/{id}', [KoszykController::class, 'dodaj'])->middleware('auth');
Route::get('koszyk/usun/{nazwa}/{id}', [KoszykController::class, 'usun'])->middleware('auth');
/* KOSZYK */
