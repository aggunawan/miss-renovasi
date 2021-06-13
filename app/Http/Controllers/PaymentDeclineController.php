<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\Payment;

class PaymentDeclineController extends Controller
{
    public function store(Payment $payment)
    {
        $payment->status = PaymentStatus::Decline;
        $payment->save();

        return redirect()->back();
    }
}
