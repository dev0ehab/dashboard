<?php

namespace Modules\Subscriptions\Http\Controllers\Api;

use App\Traits\CrudTraits\StatusTrait;
use DB;
use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Subscriptions\Entities\PlanCategory;
use Modules\Subscriptions\Http\Requests\PlanCategoryRequest;
use Modules\Subscriptions\Repositories\PlanCategoryRepository;
use Modules\Subscriptions\Transformers\PlanCategoryBreifResource;
use Modules\Subscriptions\Transformers\PlanCategoryResource;

class PlanCategoryController extends BaseModelController
{
    use StatusTrait;
    protected $class = PlanCategory::class;
    protected $form_request = PlanCategoryRequest::class;
    protected $module_name = 'subscriptions';
    protected $additional_module_name = 'plan_categories';
    protected $permission = 'plan_categories';
    protected $repository = PlanCategoryRepository::class;
    protected $resource = PlanCategoryResource::class;
    protected $brief_resource = PlanCategoryBreifResource::class;

    /**
     * Determine if the specified model can be deleted.
     *
     * @param mixed $model The model to check.
     * @return bool True if the model can be deleted, false otherwise.
     */
    protected function canDelete($model): bool
    {
        return DB::table("plans")->where("plan_category_id", $model->id)->count() == 0;
    }
}
