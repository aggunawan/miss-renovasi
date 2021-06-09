<?php

namespace App\Observers;

use App\Enums\PaymentStatus;
use App\Models\Payment;
use Str;

class PaymentObserver
{
    public function creating(Payment $payment)
    {
        $payment->code = $payment->code ?? Str::uuid();
        $payment->status = PaymentStatus::Created;
    }

    public function created(Payment $payment)
    {
        //
    }

    public function updated(Payment $payment)
    {
        //
    }

    public function deleted(Payment $payment)
    {
        //
    }

    public function restored(Payment $payment)
    {
        //
    }

    public function forceDeleted(Payment $payment)
    {
        //
    }
}
