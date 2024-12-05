<?php

namespace Modules\Menus\Http\Controllers\Api;

use App\Traits\CrudTraits\StatusTrait;
use DB;
use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Menus\Entities\Menu;
use Modules\Menus\Http\Requests\MenuRequest;
use Modules\Menus\Repositories\MenuRepository;
use Modules\Menus\Transformers\MenuBreifResource;
use Modules\Menus\Transformers\MenuResource;

class MenuController extends BaseModelController
{
    use StatusTrait;
    protected $class = Menu::class;
    protected $form_request = MenuRequest::class;
    protected $module_name = 'menus';
    protected $additional_module_name = 'menus';
    protected $permission = 'menus';
    protected $repository = MenuRepository::class;
    protected $resource = MenuResource::class;
    protected $brief_resource = MenuBreifResource::class;

    /**
     * Determine if the specified model can be deleted.
     *
     * @param mixed $model The model to check.
     * @return bool True if the model can be deleted, false otherwise.
     */
    protected function canDelete($model): bool
    {
        return DB::table("admins")->where("menu_id", $model->id)->count() == 0;
    }
}
