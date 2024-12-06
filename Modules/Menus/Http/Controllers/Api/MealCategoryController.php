<?php

namespace Modules\Menus\Http\Controllers\Api;

use App\Traits\CrudTraits\StatusTrait;
use DB;
use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Menus\Entities\MealCategory;
use Modules\Menus\Http\Requests\MealCategoryRequest;
use Modules\Menus\Repositories\MealCategoryRepository;
use Modules\Menus\Transformers\MealCategoryBreifResource;
use Modules\Menus\Transformers\MealCategoryResource;

class MealCategoryController extends BaseModelController
{
    use StatusTrait;

    protected $class = MealCategory::class;
    protected $form_request = MealCategoryRequest::class;
    protected $module_name = 'menus';
    protected $additional_module_name = 'meal_categories';
    protected $permission = 'meal_categories';
    protected $repository = MealCategoryRepository::class;
    protected $resource = MealCategoryResource::class;
    protected $brief_resource = MealCategoryBreifResource::class;


    protected $un_active_middlewares = ['index'];

    /**
     * Determine if the specified model can be deleted.
     *
     * @param mixed $model The model to check.
     * @return bool True if the model can be deleted, false otherwise.
     */
    protected function canDelete($model): bool
    {
        return DB::table("meals")->where("meal_category_id", $model->id)->count() == 0;
    }
}
