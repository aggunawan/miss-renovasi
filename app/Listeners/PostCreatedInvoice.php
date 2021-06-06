<?php

namespace App\Listeners;

use App\Events\InvoiceCreated;
use App\Models\InvoiceHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostCreatedInvoice
{
    public function __construct()
    {
        //
    }

    public function handle(InvoiceCreated $event)
    {
        $history = new InvoiceHistory([
            'message' => "Invoice {$event->invoice->number} created by {$event->invoice->user->name} at {$event->invoice->created_at->toDateTimeString()}"
        ]);

        $history->invoice_id = $event->invoice->id;
        $history->save();

        $event->invoice->latest_status = $history->message;
        $event->invoice->save();
    }
}
