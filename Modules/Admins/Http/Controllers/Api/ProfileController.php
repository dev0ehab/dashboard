<?php

namespace Modules\Admins\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseProfileController;
use Modules\Admins\Entities\Admin;

class ProfileController extends BaseProfileController
{
    protected $class = Admin::class;
}
