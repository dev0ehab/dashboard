<?php

namespace Modules\Roles\Entities;

use Astrotomic\Translatable\Translatable;
use Laratrust\Models\Permission as LaratrustPermission;

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

}
