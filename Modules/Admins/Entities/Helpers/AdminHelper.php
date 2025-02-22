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
        return optional($this->role?->permissions()->where('name', 'like', 'create_%')->orWhere('name', 'like', 'index_%')->pluck('name')->toArray(), fn($p) => []);
    }
}
