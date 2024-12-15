<?php

namespace Modules\Settings\Http\Controllers\Api;


use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Settings\Entities\Contactus;
use Modules\Settings\Http\Requests\ContactusRequest;
use Modules\Settings\Repositories\ContactusRepository;
use Modules\Settings\Transformers\ContactusBreifResource;
use Modules\Settings\Transformers\ContactusResource;

class ContactusController extends BaseModelController
{
    protected $class = Contactus::class;
    protected $form_request = ContactusRequest::class;
    protected $module_name = 'settings';
    protected $additional_module_name = 'contact-us';
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
