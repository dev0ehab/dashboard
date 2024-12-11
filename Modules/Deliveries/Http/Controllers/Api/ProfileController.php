<?php

namespace Modules\Deliveries\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseProfileController;
use Modules\Deliveries\Entities\Delivery;
use Modules\Deliveries\Http\Requests\DeliveryProfileRequest;

class ProfileController extends BaseProfileController
{
    protected $class = Delivery::class;
    protected $profileRequest = DeliveryProfileRequest::class;
}
