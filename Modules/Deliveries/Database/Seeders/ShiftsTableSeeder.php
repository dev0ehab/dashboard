<?php

namespace Modules\Deliveries\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Deliveries\Entities\Shift;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ShiftsTableSeeder extends Seeder
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
            count($this->shifts())
        );

        $bar->start();

        foreach ($this->shifts() as $shift) {
            Shift::create($shift);
        }
        $bar->finish();
        $this->command->info("\n");
    }

    private function shifts()
    {
        return [
            [
                'city_id' => 1,
                'address' => 'riyad , saudi arabia',
                'name:ar' => "فرع الرياض الرئيسي",
                'name:en' => 'Riyadh Main Shift',
                'lat' => '23.88',
                'long' => '45.07',
                'is_active' => true
            ],
            [
                'city_id' => 20,
                'address' => 'abu dhabi , united arab emirates',
                'name:ar' => "فرع ابوظبي الرئيسي",
                'name:en' => 'Abu Dhabi Main Shift',
                'lat' => '23.42',
                'long' => '53.84',
                'is_active' => true
            ],

        ];
    }
}
