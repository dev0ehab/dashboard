<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Users\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = User::Create([
            'f_name' => 'Mr',
            'l_name' => 'Root',
            'email' => 'root@demo.com',
            'phone' => '+96643037411',
            'dial_code' => '+05',
            'password' => 'Aa@12345',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);


        $user = User::firstOrCreate([
            'f_name' => 'Mr',
            'l_name' => 'User',
            'email' => 'user@demo.com',
            'phone' => '+96643037412',
            'dial_code' => '+05',
            'password' => 'Aa@12345',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);
        $this->command->info("users created successfully");

    }
}
