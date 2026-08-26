<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\MecanicienController;
use App\Http\Controllers\PieceController;
use App\Http\Controllers\ReparationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TypeDiagnosticController;
use App\Http\Controllers\TypeReparationController;
use App\Http\Controllers\TypeVehiculeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculeController;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Diagnostic;
use App\Models\Entreprise;
use App\Models\Marque;
use App\Models\Mecanicien;
use App\Models\Piece;
use App\Models\Reparation;
use App\Models\Vehicule;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard', [
        'counts' => [
            'clients' => Client::count(),
            'vehicules' => Vehicule::count(),
            'reparations' => Reparation::count(),
            'diagnostics' => Diagnostic::count(),
            'pieces' => Piece::count(),
            'mecaniciens' => Mecanicien::count(),
            'categories' => Categorie::count(),
            'marques' => Marque::count(),
            'entreprises' => Entreprise::count(),
        ],
    ]);
})->name('home');

Route::resource('clients', ClientController::class);
Route::resource('vehicules', VehiculeController::class);
Route::resource('reparations', ReparationController::class);
Route::resource('diagnostics', DiagnosticController::class);
Route::resource('pieces', PieceController::class);
Route::resource('mecaniciens', MecanicienController::class);
Route::resource('categories', CategorieController::class)
    ->parameters(['categories' => 'categorie']);
Route::resource('marques', MarqueController::class);
Route::resource('roles', RoleController::class);
Route::resource('entreprises', EntrepriseController::class);
Route::resource('users', UserController::class);

Route::resource('type-vehicules', TypeVehiculeController::class)
    ->parameters(['type-vehicules' => 'typeVehicule']);
Route::resource('type-reparations', TypeReparationController::class)
    ->parameters(['type-reparations' => 'typeReparation']);
Route::resource('type-diagnostics', TypeDiagnosticController::class)
    ->parameters(['type-diagnostics' => 'typeDiagnostic']);
