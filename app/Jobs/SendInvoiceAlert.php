<?php

namespace App\Jobs;

use App\Enums\InvoiceStatus;
use App\Mail\InvoiceAlert;
use App\Models\Invoice;
use App\Models\InvoiceHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use PDF;

class SendInvoiceAlert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function handle()
    {
        $pdf = PDF::loadView('pdf.statements.show', ['invoice' => $this->invoice])->output();

        Mail::to($this->invoice->customer->email)->send(new InvoiceAlert($this->invoice, $pdf));

        $date = now()->toDateTimeString();
        $message = "Invoice {$this->invoice->number} alert sended at {$date}";

        $this->invoice->histories(new InvoiceHistory([
            'message' => $message
        ]));

        $this->invoice->status = InvoiceStatus::Sended;
        $this->invoice->latest_status = $message;
        $this->invoice->save();

    }
}
