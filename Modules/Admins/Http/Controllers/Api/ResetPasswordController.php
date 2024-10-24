<?php

namespace Modules\Admins\Http\Controllers\Api;

use App\Http\Controllers\Authentication\BaseResetPasswordController;
use Modules\Admins\Entities\Admin;

class ResetPasswordController extends BaseResetPasswordController
{
    protected $class = Admin::class;
}
