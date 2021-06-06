<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(
            ['name' => 'Administrator'],
            ['name' => 'manage-permissions', 'guard_name' => 'web'],
        );

        Role::firstOrCreate(
            ['name' => 'Direktur'],
            ['name' => 'manage-permissions', 'guard_name' => 'web'],
        );

        Permission::firstOrCreate(
            ['name' => 'manage-permissions'],
            ['name' => 'manage-permissions', 'guard_name' => 'web'],
        );

        Permission::firstOrCreate(
            ['name' => 'manage-roles'],
            ['name' => 'manage-roles', 'guard_name' => 'web'],
        );

        Permission::firstOrCreate(
            ['name' => 'manage-accounts'],
            ['name' => 'manage-accounts', 'guard_name' => 'web'],
        );

        Permission::firstOrCreate(
            ['name' => 'manage-customers'],
            ['name' => 'manage-customers', 'guard_name' => 'web'],
        );

        Permission::firstOrCreate(
            ['name' => 'manage-bank-accounts'],
            ['name' => 'manage-bank-accounts', 'guard_name' => 'web'],
        );

        Permission::firstOrCreate(
            ['name' => 'manage-invoices'],
            ['name' => 'manage-invoices', 'guard_name' => 'web'],
        );
    }
}
