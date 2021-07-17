<?php

namespace App\Jobs;

use App\Models\Invoice;
use App\Enums\InvoiceStatus;
use App\Enums\PaymentStatus;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RescheduleUnpaidInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        $invoices = Invoice::where('status', InvoiceStatus::Sended)
            ->whereHas('payment', function ($query) {
                $query->where('status', PaymentStatus::Created);
            })
            ->get();

        foreach ($invoices as $invoice) {
            $invoice->reschedule();
        }
    }
}
