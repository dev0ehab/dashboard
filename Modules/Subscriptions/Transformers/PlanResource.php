<?php

namespace Modules\Subscriptions\Transformers;


/** @mixin \Modules\Subscriptions\Entities\Plan */
class PlanResource extends PlanBreifResource
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
            'versions' => PlanVersionResource::collection($this->versions),
            'meals' => PlanMealResource::collection($this->meals),
        ]);

    }
}
