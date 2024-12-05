<?php

namespace Modules\Menus\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseModelRepository;
use Modules\Menus\Entities\Menu;
use Modules\Menus\Http\Filters\MenuFilter;

class MenuRepository extends BaseModelRepository
{
    protected $class = Menu::class;
    protected $filter = MenuFilter::class;

}
