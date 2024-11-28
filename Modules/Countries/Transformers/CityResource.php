<?php

namespace Modules\Countries\Transformers;



/** @mixin \Modules\Countries\Entities\City */
class CityResource extends CityBreifResource
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
            'state' => StateBreifResource::make($this->state),
        ]);

    }
}
