<?php

namespace Modules\Admins\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Modules\Admins\Entities\Admin */
class AdminResource extends AdminBreifResource
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
