<?php

namespace App\Providers;

use App\Observers\ReportedCaseObserver;
use App\ReportedCase;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ReportedCase::observe(ReportedCaseObserver::class);
    }
}
