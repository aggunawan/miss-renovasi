<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\Payment;

class PaymentApproveController extends Controller
{
    public function store(Payment $payment)
    {
        $payment->status = PaymentStatus::Approved;
        $payment->save();

        return redirect()->back();
    }
}
