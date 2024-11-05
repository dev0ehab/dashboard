<?php

namespace Modules\Users\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseChangeAuthenticable;
use Modules\Users\Entities\User;

class ChangeAuthenticable extends BaseChangeAuthenticable
{
    protected $class = User::class;
}
