<?php

namespace Modules\Roles\Entities;

use Astrotomic\Translatable\Translatable;
use Laratrust\Models\Permission as LaratrustPermission;
use Modules\Roles\Transformers\PermissionResource;

class Permission extends LaratrustPermission
{
    use Translatable;
    protected $fillable = [
        'name',
    ];

    public $translatedAttributes = [
        'display_name',
    ];

    protected $with = ['translations'];

    public static function permissionMap($permissions)
    {
        return $permissions->groupBy('module')->map(function ($permission) {
            return $permission->map(function ($permission) {
                return new PermissionResource($permission);
            });
        });
    }
}
