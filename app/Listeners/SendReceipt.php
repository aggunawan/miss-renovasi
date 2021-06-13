<?php

namespace App\Listeners;

use App\Enums\InvoiceStatus;
use App\Mail\PaymentReceipt;
use App\Models\InvoiceHistory;
use App\Events\PaymentReceiptCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use PDF;

class SendReceipt implements ShouldQueue
{
    public function handle(PaymentReceiptCreated $event)
    {
        $pdf = PDF::loadView('pdf.payment-receipts.show', ['receipt' => $event->receipt])->output();
        Mail::to($event->receipt->customer->email)->send(new PaymentReceipt($event->receipt, $pdf));

        $date = now()->toDateTimeString();
        $message = "Payment Receipt with number {$event->receipt->id} sended at {$date}";

        $event->receipt->payment->invoice->histories(new InvoiceHistory([
            'message' => $message
        ]));

        $event->receipt->payment->invoice->latest_status = $message;
        $event->receipt->payment->invoice->save();
    }
}
