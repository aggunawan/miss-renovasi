<?php

namespace Tests\Feature\Models;

use App\Models\BankAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BankAccountTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_creating_bank_account_object()
    {
        $this->assertDatabaseHas('bank_accounts', [
            'id' => BankAccount::factory()->create()->id
        ]);
    }
}
