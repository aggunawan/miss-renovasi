<?php

namespace App\Listeners;

use App\Events\PaymentVerificationApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogPaymentApprove
{
    public function __construct()
    {
        // 
    }

    public function handle(PaymentVerificationApproved $event)
    {
        $date = now()->toDateTimeString();

        $event->payment->invoice->histories()->create([
            'message' => "Invoice {$event->payment->invoice->number} payment approved by {$event->user->name} at {$date}"
        ]);
    }
}
