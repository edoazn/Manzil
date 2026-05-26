<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create([
            'name' => 'admin'
        ]);

        $lenderRole = Role::create([
            'name' => 'lender'
        ]);

        $agentRole = Role::create([
            'name' => 'agent'
        ]);

        $customerRole =  Role::create([
            'name' => 'customer'
        ]);

        $user = User::create([

            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '123456789',
            'photo' => 'edo.png',
            'password' => bcrypt('password')
        ]);
        $user->assignRole($adminRole);
    }
}
