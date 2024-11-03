<?php

namespace Modules\Roles\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseModelRepository;
use Modules\Roles\Entities\Role;
use Modules\Roles\Http\Filters\RoleFilter;

class RoleRepository extends BaseModelRepository
{
    protected $class = Role::class;
    protected $filter = RoleFilter::class;


    /**
     * Store a newly created role in storage.
     *
     * @param array $data The data for creating a new role, including permissions.
     * @return Role The created Role instance with attached permissions.
     */
    public function store(array $data)
    {
        $data["name"] = strtolower(str_replace(' ', '_', $data["display_name:en"]));
        $role = $this->class::create($data);
        $role->givePermissions($data['permissions']);

        return $role;
    }

    /**
     * Update the specified role in storage.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The model instance to update.
     * @param array $data The data to update the model with, including permissions.
     * @return \Illuminate\Database\Eloquent\Model The updated model instance.
     */
    public function update($model, array $data)
    {
        $model->update($data);
        $model->syncPermissions($data['permissions']);

        return $model;
    }


}
