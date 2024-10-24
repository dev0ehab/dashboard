<?php

namespace Modules\Admins\Http\Controllers\Api;

use App\Http\Controllers\Authentication\BaseChangeAuthenticable;
use Modules\Admins\Entities\Admin;

class ChangeAuthenticable extends BaseChangeAuthenticable
{
    protected $class = Admin::class;
}
