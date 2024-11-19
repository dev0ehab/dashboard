<?php

namespace Modules\Accounts\Http\Controllers\Api;

use Modules\Accounts\Http\Requests\BaseLoginRequest;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseLoginController extends BaseController
{
    protected $loginRequest = BaseLoginRequest::class;

    /**
     * Handle a login request for the application.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $this->validationAction($this->loginRequest);

        $auth_model_type = $request->auth_type;

        $auth_model = $this->class::withTrashed()->where($auth_model_type, $request->username)->first();

        if (!$auth_model) {
            return $this->sendError(trans("$this->module_name::auth.validations.failed"));
        }

        if ($auth_model->blocked_at) {
            return $this->sendError(trans("$this->module_name::auth.validations.blocked"));
        }

        if (method_exists($auth_model, 'roles') && $auth_model->role->blocked_at) {
            return $this->sendError(trans("$this->module_name::auth.validations.blocked"));
        }

        if ($auth_model->deleted_at) {
            return $this->sendError(trans("$this->module_name::auth.validations.deleted"));
        }

        if (!Hash::check($request->password, $auth_model->password)) {
            return $this->sendError(trans("$this->module_name::auth.validations.password"));
        }

        if (!$auth_model->hasVerifiedAuth($auth_model_type)) {
            $data = $auth_model->getResource();
            return $this->sendResponse($data, trans("$this->module_name::auth.validations.$auth_model_type-not-verified"));
        }

        event(new Login('sanctum', $auth_model, false));

        $auth_model->last_login_at = Carbon::now()->toDateTimeString();
        $auth_model->preferred_locale = $request->preferred_locale ?? app()->getLocale();
        $auth_model->device_token = $request->device_token;

        $auth_model->push();

        $response = [
            'success' => true,
            'data' => $auth_model->getResource(),
            'token' => $auth_model->createToken('MyApp')->plainTextToken,
            'message' => trans("$this->module_name::auth.messages.login"),
        ];

        if (method_exists(get_class($auth_model), 'roles')) {
            $response['permissions'] = $auth_model->permissions;
        }

        return response()->json($response);
    }
}
