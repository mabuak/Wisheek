<?php

namespace App\Providers;

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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            'App\Services\Contracts\AuthServiceContract',
            'App\Services\AuthService'
        );

        $this->app->bind(
            'App\Services\Contracts\RegisterServiceContract',
            'App\Services\RegisterService'
        );

        $this->app->bind(
            'App\Services\Contracts\MailServiceContract',
            'App\Services\MailService'
        );

     $this->app->bind(
            'App\Services\Contracts\ReminderServiceContract',
            'App\Services\ReminderService'
        );

      $this->app->bind(
            'App\Services\Contracts\ScrapeServiceContract',
            'App\Services\ScrapeService'
        );


      $this->app->bind(
            'App\Services\Contracts\PinServiceContract',
            'App\Services\PinService'
        );
    }
}
