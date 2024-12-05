<?php

namespace Modules\Menus\Transformers;

use Modules\Countries\Transformers\CityBreifResource;




/** @mixin \Modules\Menus\Entities\Menu */
class MenuResource extends MenuBreifResource
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
            'city' => CityBreifResource::make($this->city),
            'state' => CityBreifResource::make($this->city->state),
            'country' => CityBreifResource::make($this->city->state->country),
        ]);

    }
}
