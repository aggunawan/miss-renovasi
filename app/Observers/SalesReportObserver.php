<?php

namespace App\Observers;

use App\Enums\ReportType;
use App\Models\SalesReport;

class SalesReportObserver
{
    public function creating(SalesReport $salesReport)
    {
        $salesReport->type = ReportType::Monthly;
    }

    public function created(SalesReport $salesReport)
    {
        //
    }

    public function updated(SalesReport $salesReport)
    {
        //
    }

    public function deleted(SalesReport $salesReport)
    {
        //
    }

    public function restored(SalesReport $salesReport)
    {
        //
    }

    public function forceDeleted(SalesReport $salesReport)
    {
        //
    }
}
