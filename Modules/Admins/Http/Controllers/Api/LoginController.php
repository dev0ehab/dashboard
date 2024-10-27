<?php

namespace Modules\Admins\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseLoginController;
use Modules\Admins\Entities\Admin;

class LoginController extends BaseLoginController
{
    protected $class = Admin::class;
}
