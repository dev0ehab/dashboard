<?php

namespace Modules\Branches\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Branches\Entities\Branch;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function run()
    {
        $bar = $this->command->getOutput()->createProgressBar(
            count($this->branches())
        );

        $bar->start();

        foreach ($this->branches() as $branch) {
            Branch::create($branch);
        }
        $bar->finish();
        $this->command->info("\n");
    }

    private function branches()
    {
        return [
            [
                'city_id' => 1,
                'address' => 'riyad , saudi arabia',
                'name:ar' => "فرع الرياض الرئيسي",
                'name:en' => 'Riyadh Main Branch',
                'lat' => '23.88',
                'long' => '45.07',
                'is_active' => true
            ],
            [
                'city_id' => 20,
                'address' => 'abu dhabi , united arab emirates',
                'name:ar' => "فرع ابوظبي الرئيسي",
                'name:en' => 'Abu Dhabi Main Branch',
                'lat' => '23.42',
                'long' => '53.84',
                'is_active' => true
            ],

        ];
    }
}
