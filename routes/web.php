<?php

declare(strict_types=1);

use App\Livewire\Dashboard\Ticket\ListTickets;
use App\Livewire\Dashboard\Workspace\CreateWorkspace;
use Illuminate\Support\Facades\Route;

Route::domain('{workspace}.'.config('app.domain'))->group(function () {
    Route::get('');
});

Route::domain(config('app.domain'))->prefix('dashboard')->as('dashboard.')->group(function () {
    Route::get('/login', App\Livewire\Dashboard\Auth\Login::class)->name('login');

    Route::middleware(['auth.dashboard', 'can-access-dashboard'])->group(function () {
        Route::middleware('has-workspace')->group(function () {
            Route::get('/', ListTickets::class)->name('tickets.index');
        });

        Route::get('/workspace/new', CreateWorkspace::class)->name('workspaces.create');
    });
});
