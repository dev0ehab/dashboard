<?php

namespace Modules\Countries\Http\Controllers\Api;

use App\Traits\CrudTraits\StatusTrait;
use DB;
use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Countries\Entities\Country;
use Modules\Countries\Http\Requests\CountryRequest;
use Modules\Countries\Repositories\CountryRepository;
use Modules\Countries\Transformers\CountryBreifResource;
use Modules\Countries\Transformers\CountryResource;

class CountryController extends BaseModelController
{
    use StatusTrait;
    protected $class = Country::class;
    protected $form_request = CountryRequest::class;
    protected $module_name = 'countries';
    protected $permission = 'countries';
    protected $repository = CountryRepository::class;
    protected $resource = CountryResource::class;
    protected $brief_resource = CountryBreifResource::class;

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
        return DB::table("branches")->where("country_id", $model->id)->count() == 0;
    }

}
