<?php

namespace Modules\Subscriptions\Transformers;


/** @mixin \Modules\Subscriptions\Entities\PlanCategory */
class PlanCategoryResource extends PlanCategoryBreifResource
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
