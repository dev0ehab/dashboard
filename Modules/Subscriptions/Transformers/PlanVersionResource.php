<?php

namespace Modules\Subscriptions\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanVersionResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number_of_days' => $this->number_of_days,
            'meal_price_per_day' => $this->meal_price_per_day,
            'delivery_price_per_day' => $this->delivery_price_per_day,
            'discount' => $this->discount,
            'price' => $this->price,
            'subscription_type' => $this->subscription_type,
        ];
    }
}
