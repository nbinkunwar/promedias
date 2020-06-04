<?php

namespace ProfessorOops\Promedias;

use Illuminate\Support\ServiceProvider;
use ProfessorOops\Promedias\Facade\AttachmentHandler;
use ProfessorOops\Promedias\Facade\Attachments;

class ProMediaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('attachments', function () {
            return new AttachmentHandler();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }
}
