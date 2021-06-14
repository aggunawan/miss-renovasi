<?php

namespace App\Listeners;

use App\Events\PaymentVerificationRequested;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogPaymentVerification
{
    public function __construct()
    {
        //
    }

    public function handle(PaymentVerificationRequested $event)
    {
        $event->payment->invoice->histories()->create([
            'message' => "Payment verification requested for Invoice {$event->payment->invoice->number} with Payment Code {$event->payment->code}"
        ]);
    }
}
