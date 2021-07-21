<?php

namespace App\Exports;

use App\Exports\Traits\HasLogo;
use App\Models\SalesReport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;

class CustomerSalesExport implements FromView, WithDrawings
{
    use HasLogo;

    protected $salesReport;

    public function __construct(SalesReport $salesReport)
    {
        $this->salesReport = $salesReport;
    }

    public function view(): View
    {
        return view('exports.customer', [
            'salesReport' => $this->salesReport
        ]);
    }
}
