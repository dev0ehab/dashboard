<?php

namespace Modules\Countries\Http\Controllers\Api;

use App\Traits\CrudTraits\StatusTrait;
use DB;
use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Countries\Entities\State;
use Modules\Countries\Http\Requests\StateRequest;
use Modules\Countries\Repositories\StateRepository;
use Modules\Countries\Transformers\StateBreifResource;
use Modules\Countries\Transformers\StateResource;

class StateController extends BaseModelController
{
    use StatusTrait;
    protected $class = State::class;
    protected $form_request = StateRequest::class;
    protected $module_name = 'countries';
    protected $additional_module_name = 'states';
    protected $permission = 'countries';
    protected $repository = StateRepository::class;
    protected $resource = StateResource::class;
    protected $brief_resource = StateBreifResource::class;

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
        return DB::table("cities")->where("state_id", $model->id)->count() == 0;
    }

}
