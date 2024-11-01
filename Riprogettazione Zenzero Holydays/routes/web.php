<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminTariffeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LangController;


Route::group(['middleware' => ['lang']], function() {
    Route::get('/', [FrontController::class,'getHome'])->name('home')->middleware(['lang']);
    Route::get('/casaVacanze', [FrontController::class,'getCasaVacanze'])->name('casaVacanze');
    Route::get('/luoghiDiInteresse', [FrontController::class,'getLuoghiDiInteresse'])->name('luoghiDiInteresse');
    Route::get('/contatti', [FrontController::class,'getContatti'])->name('contatti');
    Route::get('/lang/{lang}', [LangController::class, 'changeLanguage'])->name('setLang');



    Route::get('/user/login', [AuthController::class, 'authentication'])->name('user.login');
    Route::post('/user/login', [AuthController::class, 'login'])->name('user.login');
    Route::get('/user/logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::post('/user/register', [AuthController::class, 'registration'])->name('user.register');
    Route::get('/ajaxUser', [AuthController::class, 'ajaxCheckForEmail']);
    Route::get('/prenotazioni/calendario', [BookingController::class, 'showCalendar'])->name('calendario');
});


Route::group(['middleware' => [ 'lang','authCustom','isRegisteredUser']], function() {
    Route::get('/confermaPrenotazione/{arrivo}', [BookingController::class, 'confermaPrenotazione'])->name('prenotazione.conferma');
    Route::resource('prenotazioniUtente', BookingController::class);
    Route::get('/prenotazioniUtente/{id}/destroy/confirm', [BookingController::class, 'confirmDestroy'])->name('prenotazioniUtente.destroy.confirm');
});

Route::group(['middleware' => ['authCustom','isRegisteredOrAdmin', 'lang']], function() {
    
    Route::get('/ajaxCheckPrenotazione', [AdminBookingController::class, 'ajaxCheckPrenotazione'])->name('ajaxCheckPrenotazione');
    Route::get('/ajaxCheckTariffePrenotazione', [AdminBookingController::class, 'ajaxCheckTariffePrenotazione'])->name('ajaxCheckTariffePrenotazione');
    Route::get('/ajaxCalcolaPrezzoTotale', [AdminBookingController::class, 'ajaxCalcolaPrezzoTotale'])->name('ajaxCalcolaPrezzoTotale');
});

Route::group(['middleware' => ['authCustom','isAdmin', 'lang']], function() {

    Route::resource('prenotazioniAdmin', AdminBookingController::class);
    Route::get('/prenotazioniAdmin/{id}/destroy/confirm', [AdminBookingController::class, 'confirmDestroy'])->name('prenotazioniAdmin.destroy.confirm');

    Route::resource('tariffeAdmin', AdminTariffeController::class);
    Route::get('/tariffeAdmin/{id}/destroy/confirm', [AdminTariffeController::class, 'confirmDestroy'])->name('tariffeAdmin.destroy.confirm');
    Route::get('/ajaxCheckTariffa', [AdminTariffeController::class, 'ajaxCheckTariffa'])->name('ajaxCheckTariffa');
    Route::get('/editGruppo', [AdminTariffeController::class, 'editGruppo'])->name('tariffeAdmin.editGruppo');
    Route::get('/ajaxCheckTariffePrenotazioni', [AdminTariffeController::class, 'ajaxCheckTariffePrenotazioni'])->name('tariffeAdmin.ajaxCheckTariffePrenotazioni');
    Route::post('/tariffeAdmin/updateGruppo', [AdminTariffeController::class, 'updateGruppo'])->name('tariffeAdmin.updateGruppo');
    Route::get('/deleteGruppo', [AdminTariffeController::class, 'deleteGruppo'])->name('tariffeAdmin.deleteGruppo');

    

});


// Redirect 404 file not found error page
Route::fallback(function () {
    return view('errors.404')->with('message','Error 404 - Page not found!');
});





















