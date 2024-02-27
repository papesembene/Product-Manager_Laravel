<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Role::create(['name' => 'Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $user= Role::create(['name' => 'User']);
        //$customer = Role::create(['name'=>'Customer']);
        $admin->givePermissionTo([
            'create-role',
            'edit-role',
            'delete-role',
            'create-customer',
            'edit-customer',
            'delete-customer',
            'create-user',
            'edit-user',
            'delete-user',
            'create-product',
            'edit-product',
            'delete-product',
            'create-order',
            'edit-order',
            'delete-order',
            'view-dashboard',
            'create-category',
            'edit-category',
            'delete-category',
        ]);

        $user->givePermissionTo([
            'create-customer',
            'edit-customer',
            'delete-customer',
            'create-product',
            'delete-product',
            'create-order',
            'edit-order',
            'delete-order',
        ]);

        /*$customer->givePermissionTo([
            'view-order-details',
            'todo_order',
            'view-history-order',
            'view-profile',
        ]);*/
    }
}
