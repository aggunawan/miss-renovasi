<?php

namespace Tests\Feature\Models;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvoiceHistoryTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_creating_invoice_history_object()
    {
        $this->assertDatabaseHas('invoice_histories', [
            'id' => InvoiceHistory::factory()->create([
                'invoice_id' => Invoice::factory()->create([
                    'customer_id' => Customer::factory()->create()
                ])
            ])->id
        ]);
    }
}
