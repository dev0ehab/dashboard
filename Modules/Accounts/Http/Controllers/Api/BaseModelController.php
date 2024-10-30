<?php

namespace Modules\Accounts\Http\Controllers\Api;


class BaseModelController extends BaseController
{
    protected $class;
    protected $module_name = 'accounts';
    protected $repository;

    protected $form_request;

    protected $brief_resource;

    protected $resource;

    public function __construct()
    {
        $this->repository = new $this->repository($this->class);
    }

    public function index()
    {
        $models = $this->repository->index();
        return $this->sendResponse($this->brief_resource::collection($models)->response()->getData(true), trans("successful request"));
    }

    public function show($id)
    {
        $model = $this->repository->show($id);
        return $this->sendResponse($this->resource::make($model), trans("successful request"));
    }

    public function create()
    {
        $validated_data = $this->validationAction($this->form_request);
        $model = $this->repository->create($$validated_data);
        return $this->sendResponse($this->resource::make($model), trans("successful request"));
    }

    public function update($id)
    {
        $validated_data = $this->validationAction($this->form_request);
        $model = $this->repository->show($id);
        $this->repository->update($model, $$validated_data);
        return $this->sendResponse($this->resource::make($model->refresh()), trans("successful request"));
    }
    public function destroy($id)
    {
        $model = $this->repository->show($id);
        $this->repository->delete($model);
        return $this->sendSuccess(trans("successful request"));
    }


    public function forceDelete($id)
    {
        $model = $this->repository->show($id);
        $this->repository->forceDelete($model);
        return $this->sendResponse($this->resource::make($model->refresh()), trans("successful request"));
    }

    public function restore($id)
    {
        $model = $this->repository->show($id, true);
        $this->repository->restore($model);
        return $this->sendResponse($this->resource::make($model->refresh()), trans("successful request"));
    }
}
