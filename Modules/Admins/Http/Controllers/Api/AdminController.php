<?php

namespace Modules\Admins\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseAuthModelController;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Http\Requests\AdminRequest;
use Modules\Admins\Repositories\AdminsRepository;
use Modules\Admins\Transformers\AdminBreifResource;
use Modules\Admins\Transformers\AdminResource;


class AdminController extends BaseAuthModelController
{
    protected $class = Admin::class;
    protected $form_request = AdminRequest::class;
    protected $repository = AdminsRepository::class;
    protected $resource = AdminResource::class;
    protected $brief_resource = AdminBreifResource::class;

}
