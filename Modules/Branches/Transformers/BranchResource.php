<?php

namespace Modules\Branches\Transformers;

use Modules\Countries\Transformers\CountryResource;




/** @mixin \Modules\Branches\Entities\Branch */
class BranchResource extends BranchBreifResource
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

            'country' => CountryResource::make($this->country),
        ]);

    }
}
