<?php

namespace Modules\Subscriptions\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseModelRepository;
use Modules\Subscriptions\Entities\PlanCategory;
use Modules\Subscriptions\Http\Filters\PlanCategoryFilter;

class PlanCategoryRepository extends BaseModelRepository
{
    protected $class = PlanCategory::class;
    protected $filter = PlanCategoryFilter::class;
}
