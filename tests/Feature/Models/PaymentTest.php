<?php

namespace Tests\Feature\Models;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_payment_object()
    {
        $this->assertDatabaseHas('payments', [
            'id' => Payment::factory()->create([
                'user_id' => User::factory()->create(),
                'invoice_id' => Invoice::factory()->create([
                    'customer_id' => Customer::factory()->create(),
                ]),
            ])->id
        ]);
    }

    public function test_confirmed_at_is_carbon()
    {
        $this->assertEquals(
            'Illuminate\Support\Carbon',
            get_class(
                Payment::factory()->create([
                    'user_id' => User::factory()->create(),
                    'invoice_id' => Invoice::factory()->create([
                        'customer_id' => Customer::factory()->create(),
                    ]),
                ])->confirmed_at
            )
        );
    }

    public function test_uuid_is_auto_generated()
    {
        $this->assertDatabaseHas('payments', [
            'id' => Payment::factory()->create([
                'code' => null,
                'user_id' => User::factory()->create(),
                'invoice_id' => Invoice::factory()->create([
                    'customer_id' => Customer::factory()->create(),
                ]),
            ])->id
        ]);
    }

    public function test_confirmed_is_nullable()
    {
        $this->assertEquals(null, Payment::factory()->create([
            'user_id' => User::factory()->create(),
            'confirmed_at' => null,
            'invoice_id' => Invoice::factory()->create([
                'customer_id' => Customer::factory()->create(),
            ]),
        ])->confirmed_at);
    }
}
