<?php

namespace Modules\Deliveries\Http\Controllers\Api;

use App\Traits\CrudTraits\StatusTrait;
use DB;
use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Deliveries\Entities\Zone;
use Modules\Deliveries\Http\Requests\ZoneRequest;
use Modules\Deliveries\Repositories\ZoneRepository;
use Modules\Deliveries\Transformers\ZoneBreifResource;
use Modules\Deliveries\Transformers\ZoneResource;

class ZoneController extends BaseModelController
{
    use StatusTrait;
    protected $class = Zone::class;
    protected $form_request = ZoneRequest::class;
    protected $module_name = 'deliveries';
    protected $additional_module_name = 'zones';
    protected $permission = 'zones';
    protected $repository = ZoneRepository::class;
    protected $resource = ZoneResource::class;
    protected $brief_resource = ZoneBreifResource::class;

    /**
     * Determine if the specified model can be deleted.
     *
     * @param mixed $model The model to check.
     * @return bool True if the model can be deleted, false otherwise.
     */
    protected function canDelete($model): bool
    {
        return DB::table("deliveries")->where("zone_id", $model->id)->count() == 0;
    }
}
