<?php

namespace Modules\Deliveries\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseVerificationController;
use Modules\Deliveries\Entities\Delivery;


class VerificationController extends BaseVerificationController
{
    protected $class = Delivery::class;

}
