<?php

namespace Modules\Deliveries\Http\Controllers\Api;

use App\Traits\CrudTraits\StatusTrait;
use DB;
use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Deliveries\Entities\Shift;
use Modules\Deliveries\Http\Requests\ShiftRequest;
use Modules\Deliveries\Repositories\ShiftRepository;
use Modules\Deliveries\Transformers\ShiftBreifResource;
use Modules\Deliveries\Transformers\ShiftResource;

class ShiftController extends BaseModelController
{
    use StatusTrait;
    protected $class = Shift::class;
    protected $form_request = ShiftRequest::class;
    protected $module_name = 'deliveries';
    protected $additional_module_name = 'shifts';
    protected $permission = 'shifts';
    protected $repository = ShiftRepository::class;
    protected $resource = ShiftResource::class;
    protected $brief_resource = ShiftBreifResource::class;

    /**
     * Determine if the specified model can be deleted.
     *
     * @param mixed $model The model to check.
     * @return bool True if the model can be deleted, false otherwise.
     */
    protected function canDelete($model): bool
    {
        return DB::table("deliveries")->where("shift_id", $model->id)->count() == 0;
    }
}
