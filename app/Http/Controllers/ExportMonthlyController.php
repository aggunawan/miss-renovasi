<?php

namespace App\Http\Controllers;

use App\Exports\MonthlySalesExport;
use App\Models\SalesReport;
use Maatwebsite\Excel\Excel;

class ExportMonthlyController extends Controller
{
    public function index(SalesReport $salesReport, Excel $excel) {
        $file = new MonthlySalesExport($salesReport);
        return $excel->download($file, $salesReport->label . '.xlsx');
    }
}
