<?php

namespace Selfreliance\fixroles;

use Illuminate\Support\ServiceProvider;

class RolesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/roles.php' => config_path('roles.php')
        ], 'config');

        $this->publishes([
            __DIR__ . '/migrations/' => database_path('migrations')
        ], 'migrations');
        
        $this->registerBladeExtensions();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/roles.php', 'roles');
    }

    /**
     * Register Blade extensions.
     *
     * @return void
     */
    protected function registerBladeExtensions()
    {
        $blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

        $blade->directive('role', function ($expression) {
            return "<?php if (Auth::check() && Auth::user()->isRole{$expression}): ?>";
        });

        $blade->directive('endrole', function () {
            return "<?php endif; ?>";
        });
    }
}
