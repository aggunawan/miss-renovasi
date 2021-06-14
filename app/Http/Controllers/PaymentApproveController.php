<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Events\PaymentVerificationApproved;
use App\Models\Payment;

class PaymentApproveController extends Controller
{
    public function store(Payment $payment)
    {
        $payment->status = PaymentStatus::Approved;
        $payment->save();

        event(new PaymentVerificationApproved($payment, backpack_auth()->user()));

        return redirect()->back();
    }
}
