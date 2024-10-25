<?php

namespace Modules\Admins\Http\Controllers\Api;

use App\Http\Controllers\Authentication\BaseVerificationController;
use Modules\Admins\Entities\Admin;


class VerificationController extends BaseVerificationController
{
    protected $class = Admin::class;

}
