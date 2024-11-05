<?php

namespace Modules\Users\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseResetPasswordController;
use Modules\Users\Entities\User;


class ResetPasswordController extends BaseResetPasswordController
{
    protected $class = User::class;

}
