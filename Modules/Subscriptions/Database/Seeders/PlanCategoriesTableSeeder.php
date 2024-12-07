<?php

namespace Modules\Subscriptions\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Subscriptions\Entities\PlanCategory;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class PlanCategoriesTableSeeder extends Seeder
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
            count($this->planCategories())
        );

        $bar->start();

        foreach ($this->planCategories() as $subscription) {
            PlanCategory::create($subscription);
        }
        $bar->finish();
        $this->command->info("\n");
    }

    private function planCategories()
    {
        return [
        ];
    }
}
