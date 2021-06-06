<?php

namespace App\Listeners;

use App\Events\InvoiceCreated;
use App\Enums\InvoiceStatus;
use App\Models\InvoiceHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ScheduleInvoice
{
    public function __construct()
    {
        //
    }

    public function handle(InvoiceCreated $event)
    {
        $event->invoice->refresh();

        $history = new InvoiceHistory([
            'message' => "Invoice {$event->invoice->number} alert will be sent at {$event->invoice->getOptimizeScheuleTimestamp()}"
        ]);

        $history->invoice_id = $event->invoice->id;
        $history->save();

        $event->invoice->scheduled_at = $event->invoice->getOptimizeScheuleTimestamp();
        $event->invoice->status = InvoiceStatus::Scheduled;
        $event->invoice->latest_status = $history->message;
        $event->invoice->save();
    }
}
