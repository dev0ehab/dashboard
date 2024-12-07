<?php

namespace Modules\Subscriptions\Http\Controllers\Api;

use App\Traits\CrudTraits\StatusTrait;
use DB;
use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Subscriptions\Entities\Plan;
use Modules\Subscriptions\Http\Requests\PlanRequest;
use Modules\Subscriptions\Repositories\PlanRepository;
use Modules\Subscriptions\Transformers\PlanBreifResource;
use Modules\Subscriptions\Transformers\PlanResource;

class PlanController extends BaseModelController
{
    use StatusTrait;
    protected $class = Plan::class;
    protected $form_request = PlanRequest::class;
    protected $module_name = 'subscriptions';
    protected $additional_module_name = 'plans';
    protected $permission = 'plans';
    protected $repository = PlanRepository::class;
    protected $resource = PlanResource::class;
    protected $brief_resource = PlanBreifResource::class;

    /**
     * Determine if the specified model can be deleted.
     *
     * @param mixed $model The model to check.
     * @return bool True if the model can be deleted, false otherwise.
     */
    protected function canDelete($model): bool
    {
        return DB::table("admins")->where("Plan_id", $model->id)->count() == 0;
    }
}
