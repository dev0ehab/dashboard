<?php

namespace Modules\Users\Http\Requests;

use Modules\Accounts\Http\Requests\BaseProfileRequest;

class UserProfileRequest extends BaseProfileRequest
{
    protected $table = 'users';
}
