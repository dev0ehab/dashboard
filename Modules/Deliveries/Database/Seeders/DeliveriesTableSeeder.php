<?php

namespace Modules\Deliveries\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Deliveries\Entities\Delivery;

class DeliveriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = Delivery::Create([
            'f_name' => 'Mr',
            'l_name' => 'Root',
            'email' => 'root@demo.com',
            'phone' => '+96643037411',
            'dial_code' => '+966',
            'password' => 'Aa@12345',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);


        $delivery = Delivery::firstOrCreate([
            'f_name' => 'Mr',
            'l_name' => 'Delivery',
            'email' => 'delivery@demo.com',
            'phone' => '+96643037412',
            'dial_code' => '+966',
            'password' => 'Aa@12345',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);
        $this->command->info("deliveries created successfully");

    }
}
