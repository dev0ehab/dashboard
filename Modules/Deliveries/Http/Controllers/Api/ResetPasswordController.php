<?php

namespace Modules\Deliveries\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseResetPasswordController;
use Modules\Deliveries\Entities\Delivery;


class ResetPasswordController extends BaseResetPasswordController
{
    protected $class = Delivery::class;

}
