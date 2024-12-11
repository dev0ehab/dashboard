<?php

namespace Modules\Deliveries\Http\Requests;

use Modules\Accounts\Http\Requests\BaseProfileRequest;

class DeliveryProfileRequest extends BaseProfileRequest
{
    protected $table = 'deliveries';
}
