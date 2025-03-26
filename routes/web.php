<?php

use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    });

    Route::prefix('expenses')->group(function () {
        Route::view('/', 'expenses.index')->name('expenses.index');
        Route::view('create', 'expenses.create')->name('expenses.create');

        Route::post('store', 'ExpenseController@store')->name('expenses.store');
        Route::put('{expense}', 'ExpenseController@update')->name('expenses.update');
        Route::delete('{expense}', 'ExpenseController@destroy')->name('expenses.destroy');

        Route::middleware(['admin'])->group(function () {
            Route::view('admin', 'expenses.admin')->name('expenses.admin');
            Route::get('manage/{expense}', [ExpenseController::class, 'manage'])->name('expenses.manage');
            Route::view('reports', 'expenses.reports')->name('expenses.reports');
        });
    });

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
