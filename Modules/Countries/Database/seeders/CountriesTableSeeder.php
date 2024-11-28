<?php

namespace Modules\Countries\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Countries\Entities\Country;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class CountriesTableSeeder extends Seeder
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
            count($this->countries())
        );

        $bar->start();

        foreach ($this->countries() as $country) {

            $countryModel = Country::create(
                collect($country)->except(['flag', 'states'])->toArray()
            );

            if (isset($country['flag'])) {
                $countryModel->addMedia(__DIR__ . $country['flag'])
                    ->preservingOriginal()
                    ->toMediaCollection('images');
            }


            foreach ($country['states'] as $state) {
                $stateModel = $countryModel->states()->create(
                    collect($state)->except(['cities'])->toArray()
                );

                foreach ($state['cities'] as $city) {
                    $stateModel->cities()->create($city);
                }

            }
            $bar->advance();


        }
        $bar->finish();
        $this->command->info("\n");
    }

    private function countries()
    {
        return [
            [
                'name:ar' => 'السعودية',
                'name:en' => 'Saudi',
                'country_code' => 'sa',
                'dial_code' => '+966',
                'currency:ar' => 'ر.س',
                'currency:en' => 'SAR',
                'flag' => '/flags/133-saudi-arabia.png',
                'states' => require __DIR__ . '/cities/sa.php',
            ],

            [
                'name:ar' => 'الإمارات',
                'name:en' => 'United Arab Emirates',
                'country_code' => 'ae',
                'dial_code' => '+971',
                'currency:ar' => 'د.إ',
                'currency:en' => 'AED',
                'flag' => '/flags/151-united-arab-emirates.png',
                'states' => require __DIR__ . '/cities/ae.php',
            ],
        ];
    }
}
