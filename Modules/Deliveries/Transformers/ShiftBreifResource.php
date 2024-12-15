<?php

namespace Modules\Deliveries\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Modules\Deliveries\Entities\Shift */
class ShiftBreifResource extends JsonResource
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
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'is_active' => $this->is_active,
        ];
    }
}
