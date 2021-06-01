<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_user_object()
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', ['email' => $user->email]);
    }
}
