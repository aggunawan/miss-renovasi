<?php

namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceAlert extends Mailable
{
    use Queueable, SerializesModels;

    protected $invoice;
    protected $pdf;

    public function __construct(Invoice $invoice, $pdf)
    {
        $this->invoice = $invoice;
        $this->invoice->load(['payment']);
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this
            ->markdown('emails.invoices.alert', [
                'invoice' => $this->invoice,
            ])
            ->attachData($this->pdf, "{$this->invoice->number}.pdf", [
                'mime' => 'application/pdf',
            ]);
    }
}
