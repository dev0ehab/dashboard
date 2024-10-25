<?php

namespace Modules\Admins\Http\Controllers\Api;

use App\Http\Controllers\Authentication\BaseProfileController;
use Modules\Admins\Entities\Admin;

class ProfileController extends BaseProfileController
{
    protected $class = Admin::class;
}
