<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        config(['app.locale' => env('LOCALE', 'id')]);
        Carbon::setLocale(env('LOCALE', 'id'));
        date_default_timezone_set(env('APP_TIMEZONE', 'Asia/Jakarta'));
    }
}
