<?php

namespace Modules\Accounts\Http\Controllers\Api;

use DB;
use Str;
use Illuminate\Http\JsonResponse;


class BaseModelController extends BaseController
{
    protected $class;
    protected $module_name = 'accounts';
    protected $repository;
    protected $permission;
    protected $form_request;
    protected $brief_resource;
    protected $resource;

    public function __construct()
    {
        $this->repository = new $this->repository();
        $this->middleware("permission:read_$this->permission")->only(['index']);
        $this->middleware("permission:show_$this->permission")->only(['show']);
        $this->middleware("permission:create_$this->permission")->only(['create', 'store']);
        $this->middleware("permission:update_$this->permission")->only(['edit', 'update']);
        $this->middleware("permission:delete_$this->permission")->only(['destroy']);
        $this->middleware("permission:restore_$this->permission")->only(['restore']);
        $this->middleware("permission:forceDelete_$this->permission")->only(['forceDelete']);
        $this->middleware("permission:block_$this->permission")->only(['block', 'unblock']);
    }

    /**
     * Get all models.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $models = $this->repository->index();

        $data = $this->brief_resource::collection($models)->response()->getData(true);

        $data['permissions'] = auth()->user()->allPermissions()->filter(function ($item) {
            return Str::contains(strtolower($item['name']), $this->permission);
        })->pluck('name')->toArray();

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
        $model = $this->repository->show($id);
        return $this->sendResponse($this->resource::make($model), trans("messages.success"));
    }

    /**
     * store a new resource.
     *
     * @return JsonResponse
     */

    public function store(): JsonResponse
    {
        try {
            DB::beginTransaction();
            $validated_data = $this->validationAction($this->form_request);
            $model = $this->repository->store($validated_data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            if (method_exists($th, 'errors')) {
                $errorData = $th->errors();
            }
            return $this->sendError($th->getMessage(), $errorData ?? []);
        }

        return $this->sendResponse($this->resource::make($model), trans("$this->module_name::messages.created"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function update($id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $validated_data = $this->validationAction($this->form_request);
            $model = $this->repository->show($id);
            $this->repository->update($model, $validated_data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            if (method_exists($th, 'errors')) {
                $errorData = $th->errors();
            }
            return $this->sendError($th->getMessage(), $errorData ?? []);
        }

        return $this->sendResponse($this->resource::make($model->refresh()), trans("$this->module_name::messages.updated"));
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

        if ($check = $this->canDelete($model)) {
            $this->repository->delete($model);
        }

        $check = $check ? 'deleted' : 'not_deleted';

        return $this->sendSuccess(trans("$this->module_name::messages.$check"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id): JsonResponse
    {
        $model = $this->repository->show($id);
        $this->repository->forceDelete($model);
        return $this->sendResponse($this->resource::make($model->refresh()), trans("$this->module_name::messages.force_deleted"));
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
        return $this->sendResponse($this->resource::make($model->refresh()), trans("$this->module_name::messages.restored"));
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
