<?php

namespace Modules\Users\Transformers;


/** @mixin \Modules\Users\Entities\User */
class UserResource extends UserBreifResource
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
