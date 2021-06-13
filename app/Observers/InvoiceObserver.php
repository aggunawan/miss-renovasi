<?php

namespace App\Observers;

use App\Enums\InvoiceStatus;
use App\Events\InvoiceCreated;
use App\Models\Invoice;
use App\Exceptions\InvoiceDueLowerThanDate;

class InvoiceObserver
{
    public function creating(Invoice $invoice)
    {
        if ($invoice->due->lt($invoice->date)) throw new InvoiceDueLowerThanDate("unable to save invoice with due lower than date", 1);
        
        $invoice->status = InvoiceStatus::Created;
        $invoice->user_id = $invoice->user_id ?? backpack_auth()->user()?->id;
    }

    public function created(Invoice $invoice)
    {
        event(new InvoiceCreated($invoice));
    }

    public function updated(Invoice $invoice)
    {
        //
    }

    public function deleting(Invoice $invoice)
    {
        $invoice->histories()->delete();
        $invoice->payment->receipt()->delete();
        $invoice->payment()->delete();
    }

    public function deleted(Invoice $invoice)
    {
        // 
    }

    public function restored(Invoice $invoice)
    {
        //
    }

    public function forceDeleted(Invoice $invoice)
    {
        //
    }
}
