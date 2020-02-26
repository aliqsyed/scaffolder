<?php

namespace Aliqsyed\Scaffolder;

use Illuminate\Support\ServiceProvider;
use Aliqsyed\Scaffolder\Commands\CreateAll;
use Aliqsyed\Scaffolder\Commands\CreateModel;
use Aliqsyed\Scaffolder\Commands\CreateViews;
use Aliqsyed\Scaffolder\Commands\CreatePolicy;
use Aliqsyed\Scaffolder\Commands\CreateFactory;
use Aliqsyed\Scaffolder\Commands\CreateRequest;
use Aliqsyed\Scaffolder\Commands\ShowColumnNames;
use Aliqsyed\Scaffolder\Commands\CreateController;

class ScaffolderServiceProvider extends ServiceProvider
{
    /**
    * Register any application services.
    *
    * @return void
    */
    public function register()
    {
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->environment('testing')) {
            $this->loadMigrationsFrom(__DIR__ . '/../tests/database/migrations');
        }

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        $this->publishes([
            __DIR__ . '/../config/scaffolder.php' => config_path('scaffolder.php'),
        ], 'scaffolder.config');

        $this->publishes([
            __DIR__ . '/../stubs' => base_path('resources/vendor/aliqsyed/stubs'),
        ], 'scaffolder.stubs');

        $this->commands([
            ShowColumnNames::class,
            CreateViews::class,
            CreateController::class,
            CreatePolicy::class,
            CreateModel::class,
            CreateFactory::class,
            CreateRequest::class,
            CreateAll::class,
        ]);
    }
}
