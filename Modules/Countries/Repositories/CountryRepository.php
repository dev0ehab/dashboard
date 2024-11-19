<?php

namespace Modules\Countries\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseModelRepository;
use Modules\Countries\Entities\Country;
use Modules\Countries\Http\Filters\CountryFilter;

class CountryRepository extends BaseModelRepository
{
    protected $class = Country::class;
    protected $filter = CountryFilter::class;

}
