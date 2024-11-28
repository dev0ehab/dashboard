<?php

namespace Modules\Countries\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseModelRepository;
use Modules\Countries\Entities\City;
use Modules\Countries\Http\Filters\CityFilter;

class CityRepository extends BaseModelRepository
{
    protected $class = City::class;
    protected $filter = CityFilter::class;

}
