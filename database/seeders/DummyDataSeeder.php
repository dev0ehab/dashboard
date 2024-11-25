<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Countries\Database\Seeders\CountriesTableSeeder;
use Modules\Settings\Database\Seeders\SettingDatabaseSeeder;
use Modules\Users\Database\Seeders\UsersTableSeeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->call(LaratrustSeeder::class);
        $this->call(SettingDatabaseSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        // $this->call(PaymentsTableSeeder::class);
    }
}
