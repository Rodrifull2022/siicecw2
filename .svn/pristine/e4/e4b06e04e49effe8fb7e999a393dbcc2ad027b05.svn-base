<?php

use App\Http\Controllers\ParticipanteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check() ? redirect('/home') : redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');
});
Route::middleware('auth')->get('/participantes', [ParticipanteController::class, 'index']);
Route::middleware('auth')->group(function () {
    Route::get('/participantes', [ParticipanteController::class, 'index']);
    // Otras rutas protegidas
});


//Auth::routes();
Route::resource('/participantes',ParticipanteController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [UsersController::class, 'index'])->name('users.index');
Route::get('/participantes', [ParticipanteController::class, 'index'])->name('participantes.index');
Route::post('/participantes/{id}/edit', [ParticipanteController::class, 'edit'])->name('participantes.edit');
Route::post('/participantes/search', 'ParticipanteController@buscar')->name('buscar.participante');
Route::get('/participantes/buscar', [ParticipanteController::class, 'showSearchPopup'])->name('participantes.searchPopup');
Route::post('/participantes/buscar', [ParticipanteController::class, 'searchByCedula'])->name('participantes.searchByCedula');
Route::get('/participantes/foto/{id}', [ParticipanteController::class, 'verFoto'])->name('participantes.foto');
Route::post('getDatosRegCivil', [ParticipanteController::class, 'getDatosRegCivil'])->name('getDatosRegCivil');

//agregadas RP
Route::post('/get-provincias', [ParticipanteController::class, 'getProvincias']);
Route::post('/get-ciudades', [ParticipanteController::class, 'getCiudades']);
Route::post('/participantes/store', [ParticipanteController::class, 'store'])->name('participantes.store');
