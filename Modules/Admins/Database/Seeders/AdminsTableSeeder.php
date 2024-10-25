<?php

namespace Modules\Admins\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admins\Entities\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = Admin::Create([
            'f_name' => 'Mr',
            'l_name' => 'Root',
            'email' => 'root@demo.com',
            'phone' => '+0543037411',
            'password' => 'Aa@12345',
        ]);


        $admin = Admin::firstOrCreate([
            'f_name' => 'Mr',
            'l_name' => 'Admin',
            'email' => 'admin@demo.com',
            'phone' => '+0543037412',
            'password' => 'Aa@12345',
        ]);

        $admins = [$root, $admin];
        $bar = $this->command->getOutput()->createProgressBar(count($admins));

        $bar->start();

        foreach ($admins as $admin) {
            $admin->addRole('super_admin');
            $bar->advance();
        }

        $bar->finish();
        $this->command->info("admins roles attached successfully");

    }
}
