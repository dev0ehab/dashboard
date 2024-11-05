<?php

namespace Modules\Users\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseVerificationController;
use Modules\Users\Entities\User;


class VerificationController extends BaseVerificationController
{
    protected $class = User::class;

}
