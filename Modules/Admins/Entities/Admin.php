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
        'password'
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
