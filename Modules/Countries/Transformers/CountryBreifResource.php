<?php

namespace Modules\Countries\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Modules\Countries\Entities\Country */
class CountryBreifResource extends JsonResource
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
            'currency' => translations($this, 'currency'),
            'localized_currency' => $this->currency,
            'is_active' => $this->is_active,
            'country_code' => $this->country_code,
            'dial_code' => $this->dial_code,
            'image' => $this->image,
        ];
    }
}
