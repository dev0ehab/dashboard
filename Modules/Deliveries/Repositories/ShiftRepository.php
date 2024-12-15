<?php

namespace Modules\Deliveries\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseModelRepository;
use Modules\Deliveries\Entities\Shift;
use Modules\Deliveries\Http\Filters\ShiftFilter;

class ShiftRepository extends BaseModelRepository
{
    protected $class = Shift::class;
    protected $filter = ShiftFilter::class;

}
