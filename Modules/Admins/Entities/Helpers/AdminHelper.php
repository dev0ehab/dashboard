<?php

namespace Modules\Admins\Entities\Helpers;



trait AdminHelper
{

    public function getRoleAttribute()
    {
        return $this->roles()->first();
    }


    public function getPermissionsAttribute()
    {
        return $this->role->permissions()->where('name', 'like', 'create_%')->orWhere('name', 'like', 'read_%')->pluck('name')->toArray();
    }

}
