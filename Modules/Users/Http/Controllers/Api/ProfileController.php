<?php

namespace Modules\Users\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseProfileController;
use Modules\Users\Entities\User;

class ProfileController extends BaseProfileController
{
    protected $class = User::class;
}
