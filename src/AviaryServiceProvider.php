<?php

namespace Cbenjafield\Aviary;

use Illuminate\Support\ServiceProvider;

class AviaryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/aviary.php', 'aviary');

        $this->publishes([
            __DIR__ . '/../config/aviary.php' => config_path('aviary.php'),
        ], 'config');

        $this->app->singleton(
            abstract: AviaryService::class,
            concrete: fn () => new AviaryService()
        );
    }
}