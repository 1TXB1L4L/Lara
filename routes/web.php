<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\drugDeptController\WardController;
use App\Http\Controllers\drugDeptController\MedicineController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\drugDeptController\ExpenseController;
use App\Http\Controllers\drugDeptController\GenericController;

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
Route::middleware('role:admin')->group(function () {
    Route::resource('wards', WardController::class);
    Route::resource('medicines', MedicineController::class);
    Route::resource('expences', ExpenseController::class);
    Route::resource('generics', GenericController::class);
});

Route::middleware('role:user')->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});
