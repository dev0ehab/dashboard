<?php

namespace Modules\Branches\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Modules\Branches\Entities\Branch */
class BranchBreifResource extends JsonResource
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
            'address' => $this->address,
            'lat' => $this->lat,
            'long' => $this->long,
            'is_active' => $this->is_active,
        ];
    }
}
