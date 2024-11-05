<?php

namespace Modules\Settings\Http\Controllers\Api;

use DB;
use Illuminate\Http\JsonResponse;
use Modules\Accounts\Http\Controllers\Api\BaseModelController;
use Modules\Settings\Entities\Setting;
use Modules\Settings\Repositories\SettingRepository;
use Modules\Settings\Http\Requests\SettingRequest;
use Modules\Settings\Transformers\SettingResource;
use Str;

class SettingController extends BaseModelController
{
    protected $class = Setting::class;
    protected $form_request = SettingRequest::class;
    protected $module_name = 'settings';
    protected $permission = 'settings';
    protected $repository = SettingRepository::class;
    protected $resource = SettingResource::class;
    protected $brief_resource = SettingResource::class;



    /**
     * Get all models.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = $this->resource::make(new $this->class());

        $data['permissions'] = [
            ...auth()->user()->allPermissions()->filter(function ($item) {
                return Str::contains(strtolower($item['name']), $this->permission);
            })->map(function ($item) {
                return str_replace("_$this->permission", '', $item->name);
            })
        ];
        return $this->sendResponse($data, trans("messages.success"));
    }



    public function update($id = null): JsonResponse
    {
        $validated_data = $this->validationAction($this->form_request);

        try {
            DB::beginTransaction();
            $model = new $this->class();
            $this->repository->update($model, $validated_data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            if (method_exists($th, 'errors')) {
                $errorData = $th->errors();
            }
            return $this->sendError($th->getMessage(), $errorData ?? []);
        }

        return $this->sendResponse($this->resource::make($model->refresh()), trans("messages.updated", ['model' => $this->translated_module_name]));
    }




}
