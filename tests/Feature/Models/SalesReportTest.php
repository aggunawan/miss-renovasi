<?php

namespace Tests\Feature\Models;

use App\Enums\ReportType;
use App\Models\SalesReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SalesReportTest extends TestCase
{
    public function test_default_report_are_monthly()
    {
        $report = new SalesReport([
            'label' => 'Report Label',
            'start_date' => now()->startOfMonth()->toDateString(),
            'end_date' => now()->toDateString(),
        ]);

        $report->save();

        $this->assertEquals($report->type, ReportType::Monthly);
        $this->assertEquals($report->getType(), 'Monthly Report');
    }

    public function test_sales_report_with_customer_type()
    {
        $report = new SalesReport([
            'label' => 'Report Label',
            'start_date' => now()->startOfMonth()->toDateString(),
            'end_date' => now()->toDateString(),
            'type' => ReportType::Customer,
        ]);

        $report->save();

        $this->assertEquals($report->type, ReportType::Customer);
        $this->assertEquals($report->getType(), 'Customer Report');
    }
}
