<?php

namespace Modules\Subscriptions\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Menus\Transformers\MealCategoryBreifResource;

class PlanMealResource extends JsonResource
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
            'meal_category' => MealCategoryBreifResource::make($this->mealCategory),
            'quantity' => $this->quantity,
        ];
    }
}
