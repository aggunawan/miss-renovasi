<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Events\PaymentVerificationDeclined;
use App\Models\Payment;

class PaymentDeclineController extends Controller
{
    public function store(Payment $payment)
    {
        $payment->status = PaymentStatus::Decline;
        $payment->save();

        event(new PaymentVerificationDeclined($payment, backpack_auth()->user()));

        return redirect()->back();
    }
}
