<?php

namespace Modules\Admins\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseAuthModelController;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Http\Requests\AdminsRequest;
use Modules\Admins\Repositories\AdminsRepository;
use Modules\Admins\Transformers\AdminsBreifResource;
use Modules\Admins\Transformers\AdminsResource;

class AdminController extends BaseAuthModelController
{
    protected $class = Admin::class;
    protected $form_request = AdminsRequest::class;
    protected $permission = 'admins';
    protected $repository = AdminsRepository::class;
    protected $resource = AdminsResource::class;
    protected $brief_resource = AdminsBreifResource::class;


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
