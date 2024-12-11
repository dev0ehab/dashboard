<?php

namespace Modules\Deliveries\Transformers;


/** @mixin \Modules\Deliveries\Entities\Delivery */
class DeliveryResource extends DeliveryBreifResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
        ]);

    }
}
