<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Users\Entities\User;

use Faker\Factory as Faker;

class UsersTableRegSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 1500; $i++) {

            $users[] = [
                'f_name' => $faker->firstName(),
                'l_name' => $faker->lastName(),
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->unique()->phoneNumber,
                'dial_code' => '+05',
                'password' => 'Aa@12345',
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
            ];
        };

        User::insert($users);
        $this->command->info("users created successfully");

    }
}
