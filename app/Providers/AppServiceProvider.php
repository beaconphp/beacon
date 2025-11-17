<?php

declare(strict_types=1);

namespace App\Providers;

use App\Managers\ToastManager;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->alias(ToastManager::class, 'toast');

        $this->app->singleton(ToastManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureVite();

        $this->configureCommands();

        $this->configureDates();

        $this->configureModels();
    }

    private function configureVite(): void
    {
        Vite::useAggressivePrefetching();
    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(app()->isProduction());
    }

    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    private function configureModels(): void
    {
        Model::shouldBeStrict(! app()->isProduction());

        Model::unguard();

        Model::automaticallyEagerLoadRelationships();
    }
}
