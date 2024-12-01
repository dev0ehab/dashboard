<?php

namespace Modules\Admins\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseAuthModelRepository;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Http\Filters\AdminFilter;

class AdminRepository extends BaseAuthModelRepository
{
    protected $class = Admin::class;
    protected $filter = AdminFilter::class;


    protected function storeAddition($model, $data)
    {
        $model->permittedBranches()->sync($data['permitted_branches']);
    }

    protected function updateAddition($model, $data)
    {
        $model->permittedBranches()->sync($data['permitted_branches']);
    }
}
