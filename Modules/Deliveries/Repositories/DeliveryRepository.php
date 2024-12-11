<?php

namespace Modules\Deliveries\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseAuthModelRepository;
use Modules\Deliveries\Entities\Delivery;
use Modules\Deliveries\Http\Filters\DeliveryFilter;

class DeliveryRepository extends BaseAuthModelRepository
{
    protected $class = Delivery::class;
    protected $filter = DeliveryFilter::class;
}
