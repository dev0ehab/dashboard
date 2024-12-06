<?php

namespace Modules\Menus\Transformers;


/** @mixin \Modules\Menus\Entities\MealCategory */
class MealCategoryResource extends MealCategoryBreifResource
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
