<?php

namespace Modules\Countries\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Modules\Countries\Entities\City */
class CityBreifResource extends JsonResource
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
