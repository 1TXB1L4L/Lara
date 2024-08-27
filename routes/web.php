<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WardController;
use App\Http\Controllers\MedicineController;
use Illuminate\Support\Facades\Auth;

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
//
// should login as admin to access the following routes redirectwith message
Route::middleware('role:admin' or 'role:user')->group(function () {
    Route::resource('wards', WardController::class);
    Route::resource('medicines', MedicineController::class);
});
