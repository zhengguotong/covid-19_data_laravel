<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\IReportedCase;
use App\Repositories\Contracts\IDailyCase;
use App\Repositories\Eloquent\ReportedCaseRepository;
use App\Repositories\Eloquent\DailyCaseRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IReportedCase::class, ReportedCaseRepository::class);
        $this->app->bind(IDailyCase::class, DailyCaseRepository::class);
    }
}
