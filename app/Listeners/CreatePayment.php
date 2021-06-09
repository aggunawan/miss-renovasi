<?php

namespace App\Listeners;

use App\Events\InvoiceCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePayment
{
    public function handle(InvoiceCreated $event)
    {
        $event->invoice->payment()->create([
            'user_id' => $event->invoice->user_id
        ]);
    }
}
