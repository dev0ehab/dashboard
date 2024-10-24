<?php

namespace Modules\Admins\Http\Controllers\Api;

use App\Http\Controllers\Authentication\BaseLoginController;
use Modules\Admins\Entities\Admin;

class LoginController extends BaseLoginController
{
    protected $class = Admin::class;
}
