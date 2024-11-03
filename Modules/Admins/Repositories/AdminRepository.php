<?php

namespace Modules\Admins\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseAuthModelRepository;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Http\Filters\AdminFilter;

class AdminRepository extends BaseAuthModelRepository
{
    protected $class = Admin::class;
    protected $filter = AdminFilter::class;
}
