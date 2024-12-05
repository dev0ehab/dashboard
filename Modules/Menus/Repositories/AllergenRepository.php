<?php

namespace Modules\Menus\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseModelRepository;
use Modules\Menus\Entities\Allergen;
use Modules\Menus\Http\Filters\AllergenFilter;

class AllergenRepository extends BaseModelRepository
{
    protected $class = Allergen::class;
    protected $filter = AllergenFilter::class;

}
