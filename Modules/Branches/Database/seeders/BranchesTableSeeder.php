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

            $branchModel = Branch::create(
                collect($branch)->except(['flag'])->toArray()
            );

            if (isset($branch['flag'])) {
                $branchModel->addMedia(__DIR__ . $branch['flag'])
                    ->preservingOriginal()
                    ->toMediaCollection('images');
            }


            // foreach ($branch['cities'] as $city) {
            //     $branchModel->cities()->create($city);

            //     $bar->advance();
            // }
        }
        $bar->finish();
        $this->command->info("\n");
    }

    private function branches()
    {
        return [] ;
    }
}
