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
    protected $template;

    public function __construct(Invoice $invoice, $pdf, string $template = null)
    {
        $this->invoice = $invoice;
        $this->invoice->load(['payment']);
        $this->pdf = $pdf;
        $this->template = $template ?? 'emails.invoices.alert';
    }

    public function build()
    {
        return $this
            ->markdown($this->template, [
                'invoice' => $this->invoice,
            ])
            ->attachData($this->pdf, "{$this->invoice->number}.pdf", [
                'mime' => 'application/pdf',
            ]);
    }
}
