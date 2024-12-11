<?php

namespace Modules\Deliveries\Http\Requests;

use Modules\Accounts\Http\Requests\BaseAuthModelRequest;

class DeliveryRequest extends BaseAuthModelRequest
{
    protected $table = 'deliveries';
    protected $module_name = 'deliveries';
    protected $additional_module_name = 'deliveries';
}
