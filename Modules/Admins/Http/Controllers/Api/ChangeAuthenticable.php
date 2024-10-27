<?php

namespace Modules\Admins\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseChangeAuthenticable;
use Modules\Admins\Entities\Admin;

class ChangeAuthenticable extends BaseChangeAuthenticable
{
    protected $class = Admin::class;
}
