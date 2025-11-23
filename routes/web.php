<?php

declare(strict_types=1);

use App\Http\Controllers\AuthenticatedSessionController;
use App\Livewire\Dashboard\Settings\ManageAccount;
use App\Livewire\Dashboard\Settings\ManageWorkspace;
use App\Livewire\Dashboard\Tickets\ListTickets;
use App\Livewire\Dashboard\Users\CreateUser;
use App\Livewire\Dashboard\Users\ListUsers;
use App\Livewire\Dashboard\Workspaces\CreateWorkspace;
use Illuminate\Support\Facades\Route;

Route::domain('{workspace:slug}.'.config('app.domain'))->middleware('set-workspace-context')->group(function () {
    Route::view('/', 'workspace.show')->name('workspace.show');
    Route::get('/login', App\Livewire\Workspace\Auth\Login::class)->name('login');
});

Route::domain(config('app.domain'))->group(function () {
    Route::view('/', 'landing');

    Route::prefix('dashboard')->as('dashboard.')->group(function () {
        Route::get('/login', App\Livewire\Dashboard\Auth\Login::class)->name('login');

        Route::middleware(['auth.dashboard', 'can-access-dashboard'])->group(function () {
            Route::middleware('has-workspace')->group(function () {
                Route::get('/', ListTickets::class)->name('tickets.index');
                Route::get('/users', ListUsers::class)->name('users.index');
                Route::get('/user/new', CreateUser::class)->name('users.create');
                Route::get('/settings/workspace', ManageWorkspace::class)->name('settings.workspace');
                Route::get('/settings/account', ManageAccount::class)->name('settings.account');
            });

            Route::get('/workspace/new', CreateWorkspace::class)->name('workspaces.create');
        });
    });
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
