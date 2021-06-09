<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Jobs\SendInvoiceAlert;

class NotifyStatementController extends Controller
{
    public function store(Invoice $statement)
    {
        $date = now()->toDateTimeString();
        $statement->latest_status = "Manual alert trigger for Invoice {$statement->number} at {$date}";
        $statement->save();

        SendInvoiceAlert::dispatch($statement->load(['customer', 'bankAccount', 'user']));

        return redirect()->back();
    }
}
