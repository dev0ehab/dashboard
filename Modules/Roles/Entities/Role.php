<?php

namespace Modules\Roles\Entities;

use App\Traits\Filterable;
use Astrotomic\Translatable\Translatable;
use Laratrust\Models\Role as LaratrustRole;

class Role extends LaratrustRole
{
    use Filterable, Translatable;

    protected $fillable = [
        'name',
    ];

    public $translatedAttributes = [
        'display_name',
    ];

    protected $with = ['translations', 'permissions'];

    // Scopes --------------------------------
    public function scopeWhereRoleNot($query, $role_name)
    {
        return $query->whereNotIn('name', (array) $role_name);
    }

    public function scopeWhereRole($query, $role_name)
    {
        return $query->whereIn('name', (array) $role_name);
    }
}
