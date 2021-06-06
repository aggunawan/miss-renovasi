<?php

namespace Tests\Feature\Models;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_creating_customer_object()
    {
        $this->assertDatabaseHas('customers', [
            'id' => Customer::factory()->create()->id
        ]);
    }

    public function test_customer_phone_is_nullable()
    {
        $this->assertEquals('Unset', Customer::factory()->create(['phone' => null])->phone);
    }
}
