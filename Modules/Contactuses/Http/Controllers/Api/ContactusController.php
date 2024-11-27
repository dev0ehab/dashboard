<?php

namespace Modules\Contactuses\Http\Controllers\Api;

use DB;
use Illuminate\Http\JsonResponse;
use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Contactuses\Entities\Contactus;
use Modules\Contactuses\Http\Requests\ContactusRequest;
use Modules\Contactuses\Repositories\ContactusRepository;
use Modules\Contactuses\Transformers\ContactusBreifResource;
use Modules\Contactuses\Transformers\ContactusResource;

class ContactusController extends BaseModelController
{
    protected $class = Contactus::class;
    protected $form_request = ContactusRequest::class;
    protected $module_name = 'contactuses';
    protected $permission = 'contact-us';
    protected $repository = ContactusRepository::class;
    protected $resource = ContactusResource::class;
    protected $brief_resource = ContactusBreifResource::class;

    protected $active_middlewares = [
        'index',
        'show',
        'destroy',
    ];


    // /**
    //  * Destroy the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id): JsonResponse
    // {
    //     $model = $this->repository->show($id);

    //     if ($this->canDelete($model)) {
    //         $this->repository->forceDelete($model);
    //         return $this->sendSuccess(trans("messages.force_deleted", ['model' => $this->translated_module_name]));
    //     }

    //     return $this->sendError(trans("messages.not_deleted", ['model' => $this->translated_module_name]));
    // }
}
