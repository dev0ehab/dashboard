<?php

namespace Modules\Roles\Http\Controllers\Api;


use Illuminate\Http\JsonResponse;
use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Roles\Entities\Permission;

class PermissionController extends BaseModelController
{
    protected $class = Permission::class;
    protected $permission = 'roles';

    public function __construct()
    {
        $this->middleware("permission:read_$this->permission")->only(['index']);
    }

    /**
     * Get all models.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $models = $this->class::get();

        $data = $this->class::permissionMap($models);

        return $this->sendResponse($data, trans("messages.success"));
    }
}
