<?php

namespace Modules\Menus\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Menus\Entities\MealCategory;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class MealCategoriesTableSeeder extends Seeder
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
            count($this->mealCategories())
        );

        $bar->start();

        foreach ($this->mealCategories() as $allergen) {
            MealCategory::create($allergen);
        }
        $bar->finish();
        $this->command->info("\n");
    }

    private function mealCategories()
    {
        return [
            [

                'name:ar' => 'فطار',
                'name:en' => 'Breakfast',
            ],
            [
                'name:ar' => 'غداء',
                'name:en' => 'Lunch',
            ],
            [
                'name:ar' => 'عشاء',
                'name:en' => 'Dinner',
            ],
            [
                'name:ar' => 'سناك',
                'name:en' => 'Snack',
            ],
        ];
    }
}
