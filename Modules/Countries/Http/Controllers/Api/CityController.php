<?php

namespace Modules\Countries\Http\Controllers\Api;

use App\Traits\CrudTraits\StatusTrait;
use DB;
use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Countries\Entities\City;
use Modules\Countries\Http\Requests\CityRequest;
use Modules\Countries\Repositories\CityRepository;
use Modules\Countries\Transformers\CityBreifResource;
use Modules\Countries\Transformers\CityResource;

class CityController extends BaseModelController
{
    use StatusTrait;
    protected $class = City::class;
    protected $form_request = CityRequest::class;
    protected $module_name = 'countries';
    protected $additional_module_name = 'cities';
    protected $permission = 'countries';
    protected $repository = CityRepository::class;
    protected $resource = CityResource::class;
    protected $brief_resource = CityBreifResource::class;

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
        return DB::table("branches")->where("city_id", $model->id)->count() == 0;
    }

}
