<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Iber\Generator\ModelGeneratorProvider');
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
            $this->app->register('Way\Generators\GeneratorsServiceProvider');
            $this->app->register('Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider');
        }
    }
}
