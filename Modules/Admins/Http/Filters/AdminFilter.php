<?php

namespace Modules\Admins\Http\Filters;

use Modules\Accounts\Http\Filters\AuthModelFilter;


class AdminFilter extends AuthModelFilter
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [

    ];
}
