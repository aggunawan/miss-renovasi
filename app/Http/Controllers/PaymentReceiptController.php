<?php

namespace App\Http\Controllers;

use App\Models\PaymentReceipt;
use Illuminate\Http\Request;
use PDF;

class PaymentReceiptController extends Controller
{
    public function show(PaymentReceipt $paymentReceipt)
    {
        return PDF::loadView(
            'pdf.payment-receipts.show',
            ['receipt' => $paymentReceipt->load(['payment.invoice', 'customer'])]
        )->stream($this->getStatementName($paymentReceipt));
    }

    protected function getStatementName(PaymentReceipt $paymentReceipt)
    {
        return "{$paymentReceipt->payment->invoice->number}-{$paymentReceipt->id}.pdf";
    }
}
