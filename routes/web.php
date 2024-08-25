<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



// Route::get('wards/create', [WardController::class, 'create'])->name('wards.create');
// Route::post('wards/create', [WardController::class, 'store'])->name('wards.store');
// Route::get('wards', [WardController::class, 'index'])->name('wards.index');
// Route::get('wards/{wId}/edit', [WardController::class, 'edit'])->name('wards.edit');
// Route::put('wards/{wId}', [WardController::class, 'update'])->name('wards.update');
// Route::delete('wards/{wId}', [WardController::class, 'destroy'])->name('wards.destroy');
// Route::get('wards/{wId}', [WardController::class, 'show'])->name('wards.show');

Route::resource('wards', App\Http\Controllers\WardController::class);
Route::resource('medicines', App\Http\Controllers\MedicineController::class);
