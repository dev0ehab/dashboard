<?php

namespace Modules\Admins\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseRegisterController;
use Modules\Admins\Entities\Admin;

class RegisterController extends BaseRegisterController
{
    protected $class = Admin::class;
}
