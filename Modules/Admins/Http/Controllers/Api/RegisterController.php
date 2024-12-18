<?php

namespace Modules\Admins\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseRegisterController;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Http\Requests\RegisterRequest;

class RegisterController extends BaseRegisterController
{
    protected $class = Admin::class;

    protected $registerRequest = RegisterRequest::class;

}
