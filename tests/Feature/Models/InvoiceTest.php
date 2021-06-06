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

        $this->assertEquals($invoice->status, InvoiceStatus::Scheduled);
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

    public function test_invoice_with_two_days_gap_or_more()
    {
        $invoice = Invoice::factory()->create([
            'customer_id' => Customer::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'bank_account_id' => BankAccount::factory()->create(),
            'date' => '2021-01-01',
            'due' => '2021-01-03',
            'created_at' => '2021-01-01 12:01:23'
        ]);

        $invoice->refresh();

        $this->assertEquals($invoice->scheduled_at, '2021-01-02 12:01:23');
    }

    public function test_invoice_with_tommorrow_due()
    {
        $invoice = Invoice::factory()->create([
            'customer_id' => Customer::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'bank_account_id' => BankAccount::factory()->create(),
            'date' => '2021-01-01',
            'due' => '2021-01-02',
            'created_at' => '2021-01-01 12:01:23'
        ]);

        $invoice->refresh();

        $this->assertEquals($invoice->scheduled_at, '2021-01-01 12:16:23');
    }

    public function test_invoice_due_in_same_date()
    {
        $invoice = Invoice::factory()->create([
            'customer_id' => Customer::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'bank_account_id' => BankAccount::factory()->create(),
            'date' => '2021-01-01',
            'due' => '2021-01-01',
            'created_at' => '2021-01-01 12:00:45'
        ]);

        $invoice->refresh();

        $this->assertEquals($invoice->scheduled_at, '2021-01-01 12:15:45');
    }

    public function test_invoice_status_is_scheduled_after_scheduling()
    {
        $invoice = Invoice::factory()->create([
            'customer_id' => Customer::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'bank_account_id' => BankAccount::factory()->create(),
        ]);

        $invoice->refresh();

        $this->assertEquals($invoice->status, InvoiceStatus::Scheduled);
    }
}
