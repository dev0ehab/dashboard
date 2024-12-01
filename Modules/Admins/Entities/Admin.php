<?php

namespace Modules\Admins\Entities;

use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Modules\Accounts\Entities\AuthModel;
use Modules\Admins\Entities\Helpers\AdminHelper;
use Modules\Admins\Entities\Relations\AdminRelation;
use Modules\Admins\Entities\Scopes\AdminScope;
use Modules\Admins\Transformers\AdminResource;

class Admin extends AuthModel implements LaratrustUser
{
    use AdminHelper, HasRolesAndPermissions, AdminRelation, AdminScope;

    public const AuthType = 'email';

    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'phone',
        'dial_code',
        'preferred_locale',
        'last_login_at',
        'device_token',
        'email_verified_at',
        'phone_verified_at',
        'password',
        'branch_id',
    ];

    protected $with = [
        'branch',
    ];


    /**
     * Get the resource representation of the Admin model.
     *
     * @return \Modules\Admins\Transformers\AdminResource
     */
    public function getResource()
    {
        return new AdminResource($this);
    }
}
