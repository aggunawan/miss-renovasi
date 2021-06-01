<?php

namespace Tests\Feature\Models;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\PaymentAlert;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentAlertTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_creating_payment_alert_object()
    {
        $this->assertDatabaseHas('payment_alerts', [
            'id' => PaymentAlert::factory()->create([
                'invoice_id' => Invoice::factory()->create([
                    'customer_id' => Customer::factory()->create(),
                ]),
            ])->id
        ]);
    }
}
