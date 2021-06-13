<?php

namespace App\Events;

use App\Models\PaymentReceipt;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentReceiptCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $receipt;

    public function __construct(PaymentReceipt $paymentReceipt)
    {
        $this->receipt = $paymentReceipt;
        $this->receipt->load(['payment.invoice', 'customer']);
    }
}
