<?php

namespace App\Listeners;

use App\Enums\InvoiceStatus;
use App\Events\PaymentVerificationApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetInvoiceToPaid
{
    public function __construct()
    {
        //
    }

    public function handle(PaymentVerificationApproved $event)
    {
        $event->payment->invoice->status = InvoiceStatus::Paid;
        $event->payment->invoice->save();
    }
}
