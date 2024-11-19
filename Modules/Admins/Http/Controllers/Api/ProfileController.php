<?php

namespace Modules\Admins\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseProfileController;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Http\Requests\AdminProfileRequest;

class ProfileController extends BaseProfileController
{
    protected $class = Admin::class;
    protected $profileRequest = AdminProfileRequest::class;
}
