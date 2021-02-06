<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentsController;
// use App\Http\Controllers\TreasurysController;

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
    return view('index');
});
Route::get('/registerhealthofficer', function () {
    return view('registerhealthofficer');
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
Route::get('/hospital', function () {
    return view('hospital');
});
Route::get('/add_hospital', function () {
    return view('add_hospital');
});
Route::get('/covid_19_lists', function () {
    return view('covid_19_lists');
});
Route::get('/hierarchy-charts', function () {
    return view('hierarchy-charts');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/graphs', [App\Http\Controllers\GraphsController::class, 'index'])->name('graphs');
Route::get('/funds', [App\Http\Controllers\TreasurysController::class,'addTreasury'])->name('funds');
Route::post('/funds', [App\Http\Controllers\TreasurysController::class,'saveTreasury'])->name('funds');
Route::get('/funds', [App\Http\Controllers\TreasurysController::class,'treasuryList'])->name('funds');
Route::get('/edit_treasury/{treasury_id}', [App\Http\Controllers\TreasurysController::class,'editTreasury'])->name('edit_treasury');
Route::get('/delete_treasury/{treasury_id}', [App\Http\Controllers\TreasurysController::class,'deleteTreasury'])->name('delete_treasury');
Route::post('/update_treasury', [App\Http\Controllers\TreasurysController::class,'updateTreasury'])->name('update.treasury');

Route::get('/registerhealthofficer', [App\Http\Controllers\OfficerController::class,'addOfficer'])->name('registerhealthofficer');
Route::post('/registerhealthofficer', [App\Http\Controllers\OfficerController::class,'saveOfficer'])->name('healthofficerlists');
Route::get('/healthofficerlists', [App\Http\Controllers\OfficerController::class,'officerList'])->name('healthofficerlists');
Route::get('/edit_officer/{id}', [App\Http\Controllers\OfficerController::class,'editOfficer'])->name('edit_officer');
Route::get('/delete_officer/{id}', [App\Http\Controllers\OfficerController::class,'deleteOfficer'])->name('delete_officer');
Route::post('/update_officer', [App\Http\Controllers\OfficerController::class,'updateOfficer'])->name('update.officer');

Route::get('/add_hospital', [App\Http\Controllers\HospitalController::class,'addHospital'])->name('add_hospital');
Route::post('/add_hospital', [App\Http\Controllers\HospitalController::class,'saveHospital'])->name('add_hospital');
Route::get('/hospital', [App\Http\Controllers\HospitalController::class,'hospitalList'])->name('hospital');
Route::get('/edit_hospital/{hospital_id}}', [App\Http\Controllers\HospitalController::class,'editHospital'])->name('edit_hospital');
Route::get('/delete_hospital/{hospital_id}}', [App\Http\Controllers\HospitalController::class,'deleteHospital'])->name('delete.hospital');
Route::post('/update_hospital', [App\Http\Controllers\HospitalController::class,'updateHospital'])->name('update.hospital');

Route::get('/national_hospital', [App\Http\Controllers\NationalController::class,'addNational'])->name('national_hospital');
Route::post('/national_hospital', [App\Http\Controllers\NationalController::class,'saveNational'])->name('national_hospital');
Route::get('/national_hospital', [App\Http\Controllers\NationalController::class,'nationalList'])->name('national_hospital');

Route::get('/regional_hospital', [App\Http\Controllers\RegionalController::class,'addRegional'])->name('regional_hospital');
Route::post('/regional_hospital', [App\Http\Controllers\RegionalController::class,'saveRegional'])->name('regional_hospital');
Route::get('/regional_hospital', [App\Http\Controllers\RegionalController::class,'regionalList'])->name('regional_hospital');


Route::get('graphs', [App\Http\Controllers\TreasurysController::class, 'showGraph'])->name('graphs');

 Route::get('hospital_graph', [App\Http\Controllers\HospitalController::class, 'hospitalGraph'])->name('hospital_graph');

Route::get('/payments', [PaymentsController::class, 'index'])->name('payments');
Route::post('/payments', [PaymentsController::class, 'store']);

Route::get('/pending_list', [App\Http\Controllers\PendingController::class, 'PendingList'])->name('pending_list');

Route::get('/officersRegional', [App\Http\Controllers\PendingController::class, 'officersRegional'])->name('officersRegional');

Route::get('/officersNational', [App\Http\Controllers\PendingController::class, 'officersNational'])->name('officersNational');
Route::get('/covid_19_lists', [App\Http\Controllers\PatientsController::class,'index'])->name('covid_19_lists');