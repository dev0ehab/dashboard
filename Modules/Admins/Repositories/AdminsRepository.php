<?php

namespace Modules\Admins\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseAuthModelRepository;
use Modules\Admins\Http\Filters\AdminsFilter;

class AdminsRepository extends BaseAuthModelRepository
{
    protected $filter = AdminsFilter::class;

}
