<?php

namespace Modules\Menus\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseModelRepository;
use Modules\Menus\Entities\MealCategory;
use Modules\Menus\Http\Filters\MealCategoryFilter;

class MealCategoryRepository extends BaseModelRepository
{
    protected $class = MealCategory::class;
    protected $filter = MealCategoryFilter::class;

}
