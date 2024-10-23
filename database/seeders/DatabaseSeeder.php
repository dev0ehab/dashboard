<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->call('media-library:clean');

        $this->command->warn('Do not consider seed dummy data while in production mode!');

        $this->call([
            DummyDataSeeder::class,
        ]);
    }
}
