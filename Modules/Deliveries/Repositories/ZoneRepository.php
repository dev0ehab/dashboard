<?php

namespace Modules\Deliveries\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseModelRepository;
use Modules\Deliveries\Entities\Zone;
use Modules\Deliveries\Http\Filters\ZoneFilter;

class ZoneRepository extends BaseModelRepository
{
    protected $class = Zone::class;
    protected $filter = ZoneFilter::class;

}
