<?php

namespace Modules\Deliveries\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseChangeAuthenticable;
use Modules\Deliveries\Entities\Delivery;

class ChangeAuthenticable extends BaseChangeAuthenticable
{
    protected $class = Delivery::class;
}
