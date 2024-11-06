<?php

namespace Modules\Admins\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Http\Requests\AdminRequest;
use Modules\Admins\Repositories\AdminRepository;
use Modules\Admins\Transformers\AdminBreifResource;
use Modules\Admins\Transformers\AdminResource;

class AdminController extends BaseModelController
{
    protected $class = Admin::class;
    protected $form_request = AdminRequest::class;
    protected $module_name = 'admins';
    protected $permission = 'admins';
    protected $repository = AdminRepository::class;
    protected $resource = AdminResource::class;
    protected $brief_resource = AdminBreifResource::class;


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
