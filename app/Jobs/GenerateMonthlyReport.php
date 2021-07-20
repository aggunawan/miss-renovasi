<?php

namespace App\Jobs;

use App\Models\Invoice;
use App\Models\SalesReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateMonthlyReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $salesReport;

    public function __construct(SalesReport $salesReport)
    {
        $this->salesReport = $salesReport;
    }

    public function handle()
    {
        $content = collect();

        $invoices = Invoice::whereBetween('date', [
            $this->salesReport->start_date,
            $this->salesReport->end_date
        ])->with([
            'customer'
        ])->get();

        foreach ($invoices as $invoice) {
            $content->push([
                'due' => $invoice->due->toDateString(),
                'customer' => $invoice->customer->name,
                'address' => $invoice->customer->address,
                'total' => $invoice->getSubTotal(),
                'status' => $invoice->getDescriptiveStatus(),
            ]);
        }

        $this->salesReport->content = $content->toArray();
        $this->salesReport->save();
    }
}
