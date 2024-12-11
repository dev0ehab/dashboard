<?php

namespace Modules\Deliveries\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Deliveries\Entities\Delivery;

use Faker\Factory as Faker;

class DeliveriesTableRegSeeder extends Seeder
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

            $deliveries[] = [
                'f_name' => $faker->firstName(),
                'l_name' => $faker->lastName(),
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->unique()->phoneNumber,
                'dial_code' => '+966',
                'password' => 'Aa@12345',
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
            ];
        };

        Delivery::insert($deliveries);
        $this->command->info("deliveries created successfully");

    }
}
