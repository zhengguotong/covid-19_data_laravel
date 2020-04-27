<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\{
    IReportedCase,
    IDailyCase
};
use App\Repositories\Eloquent\{
    ReportedCaseRepository,
    DailyCaseRepository
};

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
