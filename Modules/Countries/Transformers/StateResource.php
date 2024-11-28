<?php

namespace Modules\Countries\Transformers;



/** @mixin \Modules\Countries\Entities\State */
class StateResource extends StateBreifResource
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
            'cities' => CityBreifResource::collection($this->cities),
        ]);

    }
}
