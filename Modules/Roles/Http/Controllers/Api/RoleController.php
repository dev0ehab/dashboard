<?php

namespace Modules\Roles\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Roles\Entities\Role;
use Modules\Roles\Http\Requests\RoleRequest;
use Modules\Roles\Repositories\RoleRepository;
use Modules\Roles\Transformers\RoleBreifResource;
use Modules\Roles\Transformers\RoleResource;

class RoleController extends BaseModelController
{
    protected $class = Role::class;
    protected $form_request = RoleRequest::class;
    protected $module_name = 'roles';
    protected $permission = 'roles';
    protected $repository = RoleRepository::class;
    protected $resource = RoleResource::class;
    protected $brief_resource = RoleBreifResource::class;


        /**
     * Destroy the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        $model = $this->repository->show($id);

        if ($check = $this->canDelete($model)) {
            $this->repository->forceDelete($model);
        }

        $check = $check ? 'deleted' : 'not_deleted';

        return $this->sendSuccess(trans("$this->module_name::messages.$check"));
    }


    /**
     * Determine if the specified model can be deleted.
     *
     * @param mixed $model The model to check.
     * @return bool True if the model can be deleted, false otherwise.
     */
    protected function canDelete($model): bool
    {
        return true;
    }
}
