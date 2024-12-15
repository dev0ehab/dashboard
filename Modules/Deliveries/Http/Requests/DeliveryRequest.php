<?php

namespace Modules\Deliveries\Http\Requests;

use Modules\Accounts\Http\Requests\BaseAuthModelRequest;

class DeliveryRequest extends BaseAuthModelRequest
{
    protected $table = 'deliveries';
    protected $module_name = 'deliveries';
    protected $additional_module_name = 'deliveries';



    protected function createRules(): array
    {
        return array_merge(parent::createRules(), [
            "zone_id" => ['required', 'exists:zones,id'],
            "shift_id" => ['required', 'exists:shifts,id'],
        ]);
    }
    protected function updateRules(): array
    {
        return array_merge(parent::updateRules(), [
            "zone_id" => ['sometimes', 'exists:zones,id'],
            "shift_id" => ['sometimes', 'exists:shifts,id'],
        ]);
    }
}
