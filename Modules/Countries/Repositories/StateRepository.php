<?php

namespace Modules\Countries\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseModelRepository;
use Modules\Countries\Entities\State;
use Modules\Countries\Http\Filters\StateFilter;

class StateRepository extends BaseModelRepository
{
    protected $class = State::class;
    protected $filter = StateFilter::class;

}
