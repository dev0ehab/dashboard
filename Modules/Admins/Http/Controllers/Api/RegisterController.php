<?php

namespace Modules\Admins\Http\Controllers\Api;

use App\Http\Controllers\Authentication\BaseRegisterController;
use Modules\Admins\Entities\Admin;

class RegisterController extends BaseRegisterController
{
    protected $class = Admin::class;
}
