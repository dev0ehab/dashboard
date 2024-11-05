<?php

namespace Modules\Users\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseAuthModelController;
use Modules\Users\Entities\User;
use Modules\Users\Http\Requests\UserRequest;
use Modules\Users\Repositories\UserRepository;
use Modules\Users\Transformers\UserBreifResource;
use Modules\Users\Transformers\UserResource;

class UserController extends BaseAuthModelController
{
    protected $class = User::class;
    protected $form_request = UserRequest::class;
    protected $module_name = 'users';
    protected $permission = 'users';
    protected $repository = UserRepository::class;
    protected $resource = UserResource::class;
    protected $brief_resource = UserBreifResource::class;


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
