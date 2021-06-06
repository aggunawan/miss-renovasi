<?php

namespace Tests\Feature\Models;

use App\Models\BankAccount;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\PaymentAlert;
use App\Models\User;
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
                        'user_id' => User::factory()->create(),
                        'bank_account_id' => BankAccount::factory()->create(),
                    ]),
            ])->id
        ]);
    }
}
