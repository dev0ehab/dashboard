<?php

namespace Modules\Users\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseAuthModelRepository;
use Modules\Users\Entities\User;
use Modules\Users\Http\Filters\UserFilter;

class UserRepository extends BaseAuthModelRepository
{
    protected $class = User::class;
    protected $filter = UserFilter::class;
}
