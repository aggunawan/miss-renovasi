<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use PDF;

class StatementController extends Controller
{
    public function show(Invoice $statement)
    {
        return PDF::loadView(
            'pdf.statements.show',
            ['invoice' => $statement->load(['customer', 'bankAccount', 'user'])]
        )->stream($this->getStatementName($statement));
    }

    protected function getStatementName(Invoice $statement)
    {
        return $statement->number . ".pdf";
    }
}
