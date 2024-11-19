<?php

namespace Modules\Admins\Http\Requests;

use Modules\Accounts\Http\Requests\BaseProfileRequest;

class AdminProfileRequest extends BaseProfileRequest
{
    protected $table = 'admins';
}
