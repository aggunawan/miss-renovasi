<?php

namespace App\Listeners;

use App\Events\PaymentVerificationDeclined;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogPaymentDecline
{
    public function __construct()
    {
        //
    }

    public function handle(PaymentVerificationDeclined $event)
    {
        $event->payment->invoice->histories()->create([
            'message' => "Invoice {$event->payment->invoice->number} payment declined by {$event->user->name}"
        ]);
    }
}
