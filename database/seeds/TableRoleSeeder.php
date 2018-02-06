<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Role;

class TableRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create([
        'name' => 'Super Admin',
        'slug' => 'superadmin',
        'permissions' => [
          'create-post' => true
        ]
      ]);

        $admin = Role::create([
        'name' => 'Admin',
        'slug' => 'admin',
        'permissions' => [
          'update-post' => true,
          'publish-post' => true,
        ]
      ]);

        $customer = Role::create([
        'name' => 'Customer',
        'slug' => 'customer',
        'permissions' => [
          'add-cart' => true
        ]
      ]);

        $superAdminUser = Admin::create([
        'name' => 'Mochammad',
        'email' => 'reza.wikan.dito@gmail.com',
        'password' => bcrypt('12345'),
      ]);

        $superAdminUser->roles()->attach(1);


        $customerUser = Admin::create([
        'name' => 'Customer',
        'email' => 'customer@gmail.com',
        'password' => bcrypt('12345'),
      ]);

        $customerUser->roles()->attach(3);
    }
}
