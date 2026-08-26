<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EntrepriseAuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/entreprise/register', [EntrepriseAuthController::class, 'register'])->name('entreprise.register');
Route::post('/entreprise/login', [EntrepriseAuthController::class, 'login'])->name('entreprise.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user', function (Request $request) {
        return $request->user()->load(['role', 'entreprise']);
    })->name('user');

    Route::post('/entreprise/logout', [EntrepriseAuthController::class, 'logout'])->name('entreprise.logout');
    Route::get('/entreprise', function (Request $request) {
        return $request->user();
    })->name('entreprise.me');
});

Route::get('/clients', function (Request $request) {
    $validated = $request->validate([
        'idUser' => 'required',
    ]);
    $user = User::findOrFail($validated['idUser']);

    return response()->json($user->clients);
});
