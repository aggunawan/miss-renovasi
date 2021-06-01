<?php

namespace App\Observers;

use App\Models\Invoice;
use App\Exceptions\InvoiceDueLowerThanDate;

class InvoiceObserver
{
    public function creating(Invoice $invoice)
    {
        if ($invoice->due->lt($invoice->date)) throw new InvoiceDueLowerThanDate("unable to save invoice with due lower than date", 1);
    }

    public function created(Invoice $invoice)
    {
        //
    }

    public function updated(Invoice $invoice)
    {
        //
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
