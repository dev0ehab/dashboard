<?php

namespace Modules\Roles\Transformers;

use Modules\Roles\Entities\Permission;


/** @mixin \Modules\Roles\Entities\Role */
class RoleResource extends RoleBreifResource
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
            'permissions' => Permission::permissionMap($this->permissions),
        ]);

    }
}
