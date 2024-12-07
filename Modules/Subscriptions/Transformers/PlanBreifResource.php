<?php

namespace Modules\Subscriptions\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Modules\Subscriptions\Entities\Plan */
class PlanBreifResource extends JsonResource
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
            'localized_name' => $this->name,
            'description' => translations($this, 'description'),
            'localized_description' => $this->description,
            'is_active' => $this->is_active,
            'image' => $this->image,
        ];
    }
}
