<?php

namespace Modules\Deliveries\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseLoginController;
use Modules\Deliveries\Entities\Delivery;

class LoginController extends BaseLoginController
{
    protected $class = Delivery::class;
}
