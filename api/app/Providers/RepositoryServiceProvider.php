<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\{
    IBase,
    IReportedCase
};
use App\Repositories\Eloquent\{
    BaseRepository,
    ReportedCaseRepository
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
    }
}
