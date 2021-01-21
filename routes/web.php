<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/registerhealthofficer', function () {
    return view('registerhealthofficer');
});
Route::get('/payments', function () {
    return view('payments');
});
Route::get('/funds', function () {
    return view('funds');
});
Route::get('/healthofficerlists', function () {
    return view('healthofficerlists');
});
Route::get('/graphs', function () {
    return view('graphs');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('treasurys', 'TreasurysController');
