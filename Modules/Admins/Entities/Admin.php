<?php

namespace Modules\Admins\Entities;

use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Modules\Accounts\Entities\AuthModel;
use Modules\Admins\Entities\Helpers\AdminHelper;
use Modules\Admins\Entities\Relations\AdminRelation;
use Modules\Admins\Entities\Scopes\AdminScope;
use Modules\Admins\Transformers\AdminsResource;

class Admin extends AuthModel implements LaratrustUser
{
    use AdminHelper, HasRolesAndPermissions, AdminRelation, AdminScope;

    public const AuthType = 'email';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'phone',
        'password',
    ];

    public function getResource()
    {
        return new AdminsResource($this);
    }

}
