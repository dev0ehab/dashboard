<?php

namespace Modules\Users\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseProfileController;
use Modules\Users\Entities\User;
use Modules\Users\Http\Requests\UserProfileRequest;

class ProfileController extends BaseProfileController
{
    protected $class = User::class;
    protected $profileRequest = UserProfileRequest::class;
}
