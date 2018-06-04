<?php

namespace Eius\Alert;

use Illuminate\Support\ServiceProvider;

class AlertServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Eius\Alert\SessionStore',
            'Eius\Alert\LaravelSessionStore'
        );

        $this->app->singleton('alert', function () {
            return $this->app->make('Eius\Alert\Notifier');
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../views', 'alert');

        $this->publishes([
            __DIR__ . '/../../views' => base_path('resources/views/vendor/alert'),
        ]);

        require_once __DIR__ . '/functions.php';
    }

}
