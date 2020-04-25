<?php

namespace App\Observers;

use App\ReportedCase;

class ReportedCaseObserver
{
    /**
     * Handle the reported case "created" event.
     *
     * @param  \App\ReportedCase  $reportedCase
     * @return void
     */
    public function created(ReportedCase $reportedCase)
    {
        //
    }

    /**
     * Handle the reported case "updated" event.
     *
     * @param  \App\ReportedCase  $reportedCase
     * @return void
     */
    public function updated(ReportedCase $reportedCase)
    {
        //
    }

    /**
     * Handle the reported case "deleted" event.
     *
     * @param  \App\ReportedCase  $reportedCase
     * @return void
     */
    public function deleted(ReportedCase $reportedCase)
    {
        //
    }

    /**
     * Handle the reported case "restored" event.
     *
     * @param  \App\ReportedCase  $reportedCase
     * @return void
     */
    public function restored(ReportedCase $reportedCase)
    {
        //
    }

    /**
     * Handle the reported case "force deleted" event.
     *
     * @param  \App\ReportedCase  $reportedCase
     * @return void
     */
    public function forceDeleted(ReportedCase $reportedCase)
    {
        //
    }
}
