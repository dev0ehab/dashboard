<?php

namespace Modules\Deliveries\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseRegisterController;
use Modules\Deliveries\Entities\Delivery;

class RegisterController extends BaseRegisterController
{
    protected $class = Delivery::class;
}
