<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Hash;
use Mockery;
use ReflectionMethod;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_user_object()
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', ['email' => $user->email]);
    }

    public function test_user_roles()
    {
        $user = Mockery::mock(User::class);
        $user->shouldAllowMockingProtectedMethods();
        $user->shouldReceive('getRolesArray')->andReturn(collect(['Lorem', 'Ipsum']));

        $reflection = new ReflectionMethod(User::class, 'getRoles');

        $this->assertEquals($reflection->invoke($user), 'Lorem, Ipsum');
    }

    public function test_empty_user_roles()
    {
        $user = Mockery::mock(User::class);
        $user->shouldAllowMockingProtectedMethods();
        $user->shouldReceive('getRolesArray')->andReturn(collect([]));

        $reflection = new ReflectionMethod(User::class, 'getRoles');

        $this->assertEquals($reflection->invoke($user), 'Unassign');
    }
}
