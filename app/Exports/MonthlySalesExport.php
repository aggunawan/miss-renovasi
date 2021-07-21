<?php

namespace App\Exports;

use App\Models\SalesReport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class MonthlySalesExport implements FromView, WithDrawings
{
    protected $salesReport;

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/images/logo.jpeg'));
        $drawing->setHeight(60);
        $drawing->setCoordinates('A1');

        return $drawing;
    }


    public function __construct(SalesReport $salesReport)
    {
        $this->salesReport = $salesReport;
    }

    public function view(): View
    {
        return view('exports.monthly', [
            'salesReport' => $this->salesReport
        ]);
    }
}
