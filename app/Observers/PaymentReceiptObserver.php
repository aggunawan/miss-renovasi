<?php

namespace App\Observers;

use App\Events\PaymentReceiptCreated;
use App\Models\Invoice;
use App\Models\PaymentReceipt;
use NumberFormatter;

class PaymentReceiptObserver
{
    public function constructCounted(Invoice $invoice)
    {
        return (new NumberFormatter('id', NumberFormatter::SPELLOUT))->format($invoice->getSubTotal()) . ' rupiah';
    }

    public function creating(PaymentReceipt $paymentReceipt)
    {
        $invoice = Invoice::with(['customer', 'payment'])->find(request()->get('invoice'));

        $paymentReceipt->payment_id = $invoice->payment->id;
        $paymentReceipt->customer_id = $invoice->customer->id;
        $paymentReceipt->amount = $invoice->getSubTotal();
        $paymentReceipt->counted = strtoupper($this->constructCounted($invoice));
    }

    public function created(PaymentReceipt $paymentReceipt)
    {
        event(new PaymentReceiptCreated($paymentReceipt));
    }

    public function updated(PaymentReceipt $paymentReceipt)
    {
        //
    }

    public function deleted(PaymentReceipt $paymentReceipt)
    {
        //
    }

    public function restored(PaymentReceipt $paymentReceipt)
    {
        //
    }

    public function forceDeleted(PaymentReceipt $paymentReceipt)
    {
        //
    }
}
