<?php

namespace App\Mail;

use App\Models\PaymentReceipt as Model;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentReceipt extends Mailable
{
    use Queueable, SerializesModels;

    protected $receipt;
    protected $pdf;

    public function __construct(Model $paymentReceipt, $pdf)
    {
        $this->pdf = $pdf;
        $this->receipt = $paymentReceipt;
        $this->receipt->load(['payment.invoice']);
    }

    public function build()
    {
        return $this
            ->markdown('emails.payment-receipts.created', [
                'receipt' => $this->receipt,
            ])
            ->attachData($this->pdf, "{$this->receipt->id}.pdf", [
                'mime' => 'application/pdf',
            ]);
    }
}
