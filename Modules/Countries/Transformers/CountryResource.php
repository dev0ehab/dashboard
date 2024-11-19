<?php

namespace Modules\Countries\Transformers;



/** @mixin \Modules\Countries\Entities\Country */
class CountryResource extends CountryBreifResource
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
