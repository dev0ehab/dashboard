<?php

namespace Modules\Menus\Http\Controllers\Api;

use App\Traits\CrudTraits\StatusTrait;
use DB;
use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Menus\Entities\Allergen;
use Modules\Menus\Http\Requests\AllergenRequest;
use Modules\Menus\Repositories\AllergenRepository;
use Modules\Menus\Transformers\AllergenBreifResource;
use Modules\Menus\Transformers\AllergenResource;

class AllergenController extends BaseModelController
{
    use StatusTrait;
    protected $class = Allergen::class;
    protected $form_request = AllergenRequest::class;
    protected $module_name = 'meuus';
    protected $additional_module_name = 'allergens';
    protected $permission = 'allergens';
    protected $repository = AllergenRepository::class;
    protected $resource = AllergenResource::class;
    protected $brief_resource = AllergenBreifResource::class;

    /**
     * Determine if the specified model can be deleted.
     *
     * @param mixed $model The model to check.
     * @return bool True if the model can be deleted, false otherwise.
     */
    protected function canDelete($model): bool
    {
        return DB::table("admins")->where("allergen_id", $model->id)->count() == 0;
    }
}
