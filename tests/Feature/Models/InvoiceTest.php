<?php

namespace Tests\Feature\Models;

use App\Enums\InvoiceStatus;
use App\Exceptions\InvoiceDueLowerThanDate;
use App\Models\BankAccount;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_invoice_object()
    {
        $invoice = Invoice::factory()->create([
            'customer_id' => Customer::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'bank_account_id' => BankAccount::factory()->create(),
        ]);

        $this->assertDatabaseHas('invoices', ['id' => $invoice->id]);
    }

    public function test_content_is_nullable()
    {
        $invoice = Invoice::factory()->create([
            'contents' => null,
            'customer_id' => Customer::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'bank_account_id' => BankAccount::factory()->create(),
        ]);

        $this->assertEquals($invoice->contents, null);
    }

    public function test_content_is_array()
    {
        $invoice = Invoice::factory()->create([
            'customer_id' => Customer::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'bank_account_id' => BankAccount::factory()->create(),
        ]);

        $this->assertEquals($invoice->contents, []);
    }

    public function test_date_is_carbon()
    {
        $invoice = Invoice::factory()->create([
            'customer_id' => Customer::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'bank_account_id' => BankAccount::factory()->create(),
        ]);

        $this->assertEquals(get_class($invoice->date), 'Illuminate\Support\Carbon');
    }

    public function test_due_is_carbon()
    {
        $invoice = Invoice::factory()->create([
            'customer_id' => Customer::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'bank_account_id' => BankAccount::factory()->create(),
        ]);

        $this->assertEquals(get_class($invoice->due), 'Illuminate\Support\Carbon');
    }

    public function test_due_date_greater_than_date()
    {
        $this->expectException(InvoiceDueLowerThanDate::class);

        $invoice = Invoice::factory()->create([
            'due' => now()->subDay(),
            'customer_id' => Customer::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'bank_account_id' => BankAccount::factory()->create(),
        ]);
    }

    public function test_default_invoice_status_is_created()
    {
        $invoice = Invoice::factory()->create([
            'customer_id' => Customer::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'bank_account_id' => BankAccount::factory()->create(),
        ]);

        $this->assertEquals($invoice->status, InvoiceStatus::Created);
    }

    public function test_invoice_latest_status_is_nullable()
    {
        $invoice = Invoice::factory()->create([
            'customer_id' => Customer::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'bank_account_id' => BankAccount::factory()->create(),
        ]);

        $this->assertDatabaseHas('invoices', ['id' => $invoice->id]);
    }

    public function test_newly_created_invoice_has_single_invoice_history()
    {
        $invoice = Invoice::factory()->create([
            'customer_id' => Customer::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'bank_account_id' => BankAccount::factory()->create(),
        ]);

        $invoice->refresh();

        $this->assertNotEquals($invoice->latest_status, null);
        $this->assertDatabaseHas('invoice_histories', ['invoice_id' => $invoice->id]);
    }
}
