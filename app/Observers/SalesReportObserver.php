<?php

namespace App\Observers;

use App\Enums\ReportType;
use App\Jobs\GenerateCustomerReport;
use App\Jobs\GenerateMonthlyReport;
use App\Models\SalesReport;

class SalesReportObserver
{
    public function creating(SalesReport $salesReport)
    {
        $salesReport->type = $salesReport->type ?? ReportType::Monthly;
    }

    public function created(SalesReport $salesReport)
    {
        switch ($salesReport->type) {
            case ReportType::Monthly:
                GenerateMonthlyReport::dispatch($salesReport);
                break;
            case ReportType::Customer:
                GenerateCustomerReport::dispatch($salesReport);
                break;
            default:
                break;
        }
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
