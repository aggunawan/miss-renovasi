<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $a = User::factory()->create(['username' => 'root']);
        
        $a->givePermissionTo('manage-accounts');
        $a->givePermissionTo('manage-roles');
        $a->givePermissionTo('manage-permissions');
    }
}
