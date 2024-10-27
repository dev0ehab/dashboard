<?php

namespace Modules\Admins\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseVerificationController;
use Modules\Admins\Entities\Admin;


class VerificationController extends BaseVerificationController
{
    protected $class = Admin::class;

}
