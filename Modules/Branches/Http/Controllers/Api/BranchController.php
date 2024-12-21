<?php

namespace Modules\Branches\Http\Controllers\Api;

use App\Traits\CrudTraits\StatusTrait;
use App\Traits\MiddlewareTrait;
use DB;
use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Branches\Entities\Branch;
use Modules\Branches\Http\Requests\BranchRequest;
use Modules\Branches\Repositories\BranchRepository;
use Modules\Branches\Transformers\BranchBreifResource;
use Modules\Branches\Transformers\BranchResource;

class BranchController extends BaseModelController
{
    use StatusTrait;

    protected $class = Branch::class;
    protected $form_request = BranchRequest::class;
    protected $module_name = 'branches';
    protected $additional_module_name = 'branches';
    protected $permission = 'branches';
    protected $repository = BranchRepository::class;
    protected $resource = BranchResource::class;
    protected $brief_resource = BranchBreifResource::class;


    protected $un_active_middlewares = [
        'index',
        'show',
    ];

    /**
     * Determine if the specified model can be deleted.
     *
     * @param mixed $model The model to check.
     * @return bool True if the model can be deleted, false otherwise.
     */
    protected function canDelete($model): bool
    {
        return DB::table("admins")->where("branch_id", $model->id)->count() == 0;
    }
}
