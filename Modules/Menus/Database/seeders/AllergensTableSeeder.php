<?php

namespace Modules\Menus\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Menus\Entities\Allergen;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class AllergensTableSeeder extends Seeder
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
            count($this->allergens())
        );

        $bar->start();

        foreach ($this->allergens() as $allergen) {
            Allergen::create($allergen);
        }
        $bar->finish();
        $this->command->info("\n");
    }

    private function allergens()
    {
        return [
            [

                'name:ar' => 'جلوتين',
                'name:en' => 'Gluten'
            ],
            [

                'name:ar' => 'لوز',
                'name:en' => 'Almond'
            ],
            [

                'name:ar' => 'بيض',
                'name:en' => 'Egg'
            ],
            [

                'name:ar' => 'حليب',
                'name:en' => 'Milk'
            ],
            [

                'name:ar' => 'فول سوداني',
                'name:en' => 'Peanut'
            ],
            [

                'name:ar' => 'سمك',
                'name:en' => 'Fish'
            ],
            [

                'name:ar' => 'قشريات',
                'name:en' => 'Shellfish'
            ],
            [

                'name:ar' => 'خردل',
                'name:en' => 'Mustard'
            ],
            [

                'name:ar' => 'مكسرات',
                'name:en' => 'Tree Nuts'
            ],
            [

                'name:ar' => 'السمسم',
                'name:en' => 'Sesame'
            ],
            [

                'name:ar' => 'حبة القمح',
                'name:en' => 'Wheat'
            ],
            [

                'name:ar' => 'خضروات',
                'name:en' => 'Vegetables'
            ],
            [

                'name:ar' => 'فواكه',
                'name:en' => 'Fruits'
            ],
            [

                'name:ar' => 'كرفس',
                'name:en' => 'Celery'
            ],
            [

                'name:ar' => 'محار',
                'name:en' => 'Molluscs'
            ],
            [

                'name:ar' => 'الزبيب',
                'name:en' => 'Raisins'
            ],
            [

                'name:ar' => 'صويا',
                'name:en' => 'Soy'
            ],
            [

                'name:ar' => 'فطر',
                'name:en' => 'Mushrooms'
            ],
            [

                'name:ar' => 'شوكولاتة',
                'name:en' => 'Chocolate'
            ],
            [

                'name:ar' => 'مستحلبات',
                'name:en' => 'Emulsifiers'
            ]

        ];
    }
}
