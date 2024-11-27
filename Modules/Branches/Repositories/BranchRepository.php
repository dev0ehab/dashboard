<?php

namespace Modules\Branches\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseModelRepository;
use Modules\Branches\Entities\Branch;
use Modules\Branches\Http\Filters\BranchFilter;

class BranchRepository extends BaseModelRepository
{
    protected $class = Branch::class;
    protected $filter = BranchFilter::class;

}
