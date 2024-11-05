<?php

namespace Modules\Accounts\Http\Controllers\Api;

use Modules\Accounts\Contracts\Repositories\BaseAuthModelRepository;


class BaseAuthModelController extends BaseModelController
{
    protected $class;
    protected $module_name = 'accounts';
    protected $repository = BaseAuthModelRepository::class;
    protected $permission;
    protected $form_request;
    protected $brief_resource;
    protected $resource;

    public function block($id)
    {
        $model = $this->repository->show($id);
        $this->repository->block($model);
        return $this->sendSuccess(trans("$this->module_name::messages.blocked"));
    }

    public function unblock($id)
    {
        $model = $this->repository->show($id);
        $this->repository->unblock($model);
        return $this->sendSuccess(trans("$this->module_name::messages.unblocked"));
    }

}
