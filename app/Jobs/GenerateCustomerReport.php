<?php

namespace App\Jobs;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\SalesReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateCustomerReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $salesReport;

    public function __construct(SalesReport $salesReport)
    {
        $this->salesReport = $salesReport;
    }

    public function handle()
    {
        $contents = collect();
        $customers = Customer::whereHas('invoices', function ($query) {
            $query->whereBetween('date', [
                $this->salesReport->start_date,
                $this->salesReport->end_date
            ]);
        })->with([
            'invoices'
        ])->get();

        foreach ($customers as $customer) {
            $invoices = collect();

            foreach ($customer->invoices as $invoice) {
                $invoices->push([
                    'due' => $invoice->due->toDateString(),
                    'total' => $invoice->getSubTotal(),
                    'status' => $invoice->getDescriptiveStatus(),
                ]);
             }

            $contents->push([
                'customer' => $customer->name,
                'address' => $customer->address,
                'invoices' => $invoices->toArray(),
            ]);
        }

        $this->salesReport->content = $contents->toArray();
        $this->salesReport->save();
    }
}
