<?php

namespace Modules\Roles\Transformers;



/** @mixin \Modules\Roles\Entities\Role */
class PermissionResource extends PermissionBreifResource
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
