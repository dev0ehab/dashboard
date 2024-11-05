<?php

namespace Modules\Users\Entities;

use Modules\Accounts\Entities\AuthModel;
use Modules\Users\Entities\Helpers\UserHelper;
use Modules\Users\Entities\Relations\UserRelation;
use Modules\Users\Entities\Scopes\UserScope;
use Modules\Users\Transformers\UserResource;

class User extends AuthModel
{
    use UserHelper, UserRelation, UserScope;

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
        'password',
    ];
    /**
     * Get the resource representation of the User model.
     *
     * @return \Modules\Users\Transformers\UserResource
     */
    public function getResource()
    {
        return new UserResource($this);
    }

}
