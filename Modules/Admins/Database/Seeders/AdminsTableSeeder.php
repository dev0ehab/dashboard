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
            'dial_code' => '+05',
            'password' => 'Aa@12345',
            'branch_id' => 1,
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);


        $admin = Admin::firstOrCreate([
            'f_name' => 'Mr',
            'l_name' => 'Admin',
            'email' => 'admin@demo.com',
            'phone' => '+0543037412',
            'dial_code' => '+05',
            'password' => 'Aa@12345',
            'branch_id' => 1,
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);

        $admins = [$root, $admin];
        $bar = $this->command->getOutput()->createProgressBar(count($admins));

        $bar->start();

        foreach ($admins as $admin) {
            $admin->addRole('super_admin');
            $admin->permittedBranches()->sync([1,2]);
            $bar->advance();
        }

        $bar->finish();
        $this->command->info("admins roles attached successfully");

    }
}
