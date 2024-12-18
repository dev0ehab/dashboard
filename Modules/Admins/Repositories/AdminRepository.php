<?php

namespace Modules\Admins\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseAuthModelRepository;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Http\Filters\AdminFilter;

class AdminRepository extends BaseAuthModelRepository
{
    protected $class = Admin::class;
    protected $filter = AdminFilter::class;


    public function store($data)
    {
        $model = parent::store($data);

        $model->permittedBranches()->sync($data['permitted_branches']);

        return $model;
    }

    public function update($model, $data)
    {
        parent::update($model, $data);

        if (isset($data['permitted_branches'])) {
            $model->permittedBranches()->sync($data['permitted_branches']);
        }

        return $model->refresh();
    }
}
