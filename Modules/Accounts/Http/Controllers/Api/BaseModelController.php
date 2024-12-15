<?php

namespace Modules\Accounts\Http\Controllers\Api;

use App\Traits\CacheTrait;
use App\Traits\MiddlewareTrait;
use DB;
use Modules\Roles\Entities\Permission;
use Illuminate\Http\JsonResponse;


class BaseModelController extends BaseController
{
    use CacheTrait, MiddlewareTrait;

    protected $class;
    protected $module_name = 'accounts';
    protected $has_roles;
    protected $additional_module_name;
    protected $repository;
    protected $permission;
    protected $form_request;
    protected $brief_resource;
    protected $resource;

    public function __construct()
    {
        $this->repository = new $this->repository();
        $this->additional_module_name = $this->additional_module_name ?: $this->module_name;
        $this->translated_module_name = trans("$this->module_name::$this->additional_module_name.singular");
        $this->has_roles = user() ? method_exists(get_class(user()), 'roles') : false;
        $this->getMiddlewares();
    }

    /**
     * Get all models.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $paginated = (bool) request('is_paginated', true);

        $query = json_encode(request()->query());

        if ($this->hasCache("$this->class::index-$paginated-$query")) {

            $data = $this->getCache("$this->class::index-$paginated-$query");

            if ($this->has_roles) {

                $data->permissions = Permission::getUserPermissions(user(), $this->permission);
            }

            return $this->sendResponse($data, trans("messages.success"));
        }

        $models = $this->repository->index($paginated);

        $data = $this->brief_resource::collection($models)->response()->getData(true);

        $this->setCache("$this->class::index-$paginated-$query", $data);

        if ($this->has_roles) {

            $data['permissions'] = Permission::getUserPermissions(user(), $this->permission);
        }

        return $this->sendResponse($data, trans("messages.success"));
    }

    /**
     * Show the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        if ($this->hasCache("$this->class::show-$id")) {

            return $this->sendResponse($this->getCache("$this->class::show-$id"), trans("messages.success"));
        }

        $model = $this->repository->show($id);

        $this->setCache("$this->class::show-$model->id", $this->resource::make($model));

        return $this->sendResponse($this->resource::make($model), trans("messages.success"));
    }

    /**
     * store a new resource.
     *
     * @return JsonResponse
     */

    public function store(): JsonResponse
    {
        $validated_data = $this->validationAction($this->form_request);
        try {
            DB::beginTransaction();

            $model = $this->repository->store($validated_data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $errorData = method_exists($th, 'errors') ? $th->errors() : [];

            return $this->sendError($th->getMessage(), $errorData);
        }


        $this->removeModelCache($this->class);

        $this->setCache("$this->class::show-$model->id", $this->resource::make($model));

        return $this->sendResponse($this->resource::make($model->refresh()), trans("messages.created", ['model' => $this->translated_module_name]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function update($id): JsonResponse
    {
        $validated_data = $this->validationAction($this->form_request);

        try {
            DB::beginTransaction();

            $model = $this->repository->show($id);

            $this->repository->update($model, $validated_data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $errorData = method_exists($th, 'errors') ? $th->errors() : [];

            return $this->sendError($th->getMessage(), $errorData);
        }

        $this->removeModelCache($this->class);

        $this->setCache("$this->class::show-$model->id", $this->resource::make($model));

        return $this->sendResponse($this->resource::make($model->refresh()), trans("messages.updated", ['model' => $this->translated_module_name]));
    }

    /**
     * Destroy the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        $model = $this->repository->show($id);

        if ($this->canDelete($model)) {

            $this->repository->delete($model);

            $this->removeModelCache($this->class, $model->id);

            return $this->sendSuccess(trans("messages.deleted", ['model' => $this->translated_module_name]));
        }

        return $this->sendError(trans("messages.not_deleted", ['model' => $this->translated_module_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id): JsonResponse
    {
        $model = $this->repository->show($id, true);

        $this->repository->forceDelete($model);

        $this->removeModelCache($this->class, $model->id);

        return $this->sendSuccess(trans("messages.force_deleted", ['model' => $this->translated_module_name]));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id): JsonResponse
    {
        $model = $this->repository->show($id, true);

        $this->repository->restore($model);

        $this->removeModelCache($this->class, $model->id);

        $this->setCache("$this->class::show-$model->id", $this->resource::make($model));

        return $this->sendSuccess(trans("messages.restored", ['model' => $this->translated_module_name]));
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
