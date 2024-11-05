<?php

namespace Modules\Users\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseLoginController;
use Modules\Users\Entities\User;

class LoginController extends BaseLoginController
{
    protected $class = User::class;
}
