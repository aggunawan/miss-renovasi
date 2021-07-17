<?php

namespace App\Jobs;

use App\Enums\InvoiceStatus;
use App\Enums\PaymentStatus;
use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchResendableInvoiceAlert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        $invoices = Invoice::where('status', InvoiceStatus::Resended)
            ->whereHas('payment', function ($query) {
                $query->where('status', PaymentStatus::Created);
            })
            ->where('scheduled_at', '<=', now()->toDateTimeString())
            ->get();

        foreach ($invoices as $invoice) {
            ResendInvoiceAlert::dispatch($invoice->load(['customer', 'bankAccount', 'user']));
        }
    }
}
