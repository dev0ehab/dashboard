<?php

namespace Modules\Settings\Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Entities\ContactUs;

class ContactusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = Factory::create();

        foreach (range(1, 20) as $index) {
            ContactUs::create([
                'name' => $fake->name,
                'email' => $fake->email,
                'phone' => $fake->phoneNumber,
                'message' => $fake->text,
            ]);
        }
    }
}
