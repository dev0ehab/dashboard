<?php

namespace Modules\Menus\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Modules\Menus\Entities\MealCategory */
class MealCategoryBreifResource extends JsonResource
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
            'name' => translations($this, 'name'),
            'is_active' => $this->is_active,
        ];
    }
}
