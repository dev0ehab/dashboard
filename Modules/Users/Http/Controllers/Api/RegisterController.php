<?php

namespace Modules\Users\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseRegisterController;
use Modules\Users\Entities\User;

class RegisterController extends BaseRegisterController
{
    protected $class = User::class;
}
