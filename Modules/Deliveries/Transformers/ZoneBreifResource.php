<?php

namespace Modules\Deliveries\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Modules\Deliveries\Entities\Zone */
class ZoneBreifResource extends JsonResource
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
            'is_active' => $this->is_active,
        ];
    }
}
