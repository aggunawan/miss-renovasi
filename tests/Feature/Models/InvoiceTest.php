<?php

namespace Tests\Feature\Models;

use App\Exceptions\InvoiceDueLowerThanDate;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_invoice_object()
    {
        $invoice = Invoice::factory()->create([
            'customer_id' => Customer::factory()->create()->id
        ]);

        $this->assertDatabaseHas('invoices', ['id' => $invoice->id]);
    }

    public function test_content_is_nullable()
    {
        $invoice = Invoice::factory()->create([
            'contents' => null,
            'customer_id' => Customer::factory()->create()->id
        ]);

        $this->assertEquals($invoice->contents, null);
    }

    public function test_content_is_array()
    {
        $invoice = Invoice::factory()->create([
            'customer_id' => Customer::factory()->create()->id
        ]);

        $this->assertEquals($invoice->contents, []);
    }

    public function test_date_is_carbon()
    {
        $invoice = Invoice::factory()->create([
            'customer_id' => Customer::factory()->create()->id
        ]);

        $this->assertEquals(get_class($invoice->date), 'Illuminate\Support\Carbon');
    }

    public function test_due_is_carbon()
    {
        $invoice = Invoice::factory()->create([
            'customer_id' => Customer::factory()->create()->id
        ]);

        $this->assertEquals(get_class($invoice->due), 'Illuminate\Support\Carbon');
    }

    public function test_due_date_greater_than_date()
    {
        $this->expectException(InvoiceDueLowerThanDate::class);

        $invoice = Invoice::factory()->create([
            'due' => now()->subDay(),
            'customer_id' => Customer::factory()->create()->id,
        ]);
    }
}
