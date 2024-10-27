<?php

namespace Modules\Admins\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseResetPasswordController;
use Modules\Admins\Entities\Admin;


class ResetPasswordController extends BaseResetPasswordController
{
    protected $class = Admin::class;

}
