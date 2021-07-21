<?php

namespace App\Http\Controllers;

use App\Exports\CustomerSalesExport;
use App\Models\SalesReport;
use Maatwebsite\Excel\Excel;

class ExportCustomerController extends Controller
{
    public function index(SalesReport $salesReport, Excel $excel) {
        $file = new CustomerSalesExport($salesReport);
        return $excel->download($file, $salesReport->label . '.xlsx');
    }
}
