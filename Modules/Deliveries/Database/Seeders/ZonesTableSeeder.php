<?php

namespace Modules\Deliveries\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Deliveries\Entities\Zone;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ZonesTableSeeder extends Seeder
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
            count($this->zones())
        );

        $bar->start();

        foreach ($this->zones() as $zone) {
            Zone::create($zone);
        }
        $bar->finish();
        $this->command->info("\n");
    }

    private function zones()
    {
        return [
            [
                'city_id' => 1,
                'address' => 'riyad , saudi arabia',
                'name:ar' => "فرع الرياض الرئيسي",
                'name:en' => 'Riyadh Main Zone',
                'lat' => '23.88',
                'long' => '45.07',
                'is_active' => true
            ],
            [
                'city_id' => 20,
                'address' => 'abu dhabi , united arab emirates',
                'name:ar' => "فرع ابوظبي الرئيسي",
                'name:en' => 'Abu Dhabi Main Zone',
                'lat' => '23.42',
                'long' => '53.84',
                'is_active' => true
            ],

        ];
    }
}
