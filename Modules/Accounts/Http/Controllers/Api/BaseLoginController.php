<?php

namespace Modules\Accounts\Http\Controllers\Api;

use Modules\Accounts\Http\Requests\BaseLoginRequest;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseLoginController extends BaseAuthenticationController
{
    use ApiTrait;

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

        $auth_model = $this->class::where($auth_model_type, $request->username)->first();

        if (!$auth_model) {
            return $this->sendError(trans("$this->module_name::auth.validations.failed"));
        }

        if ($auth_model->blocked_at) {
            auth()->logout();
            return $this->sendError(trans("$this->module_name::auth.validations.blocked"));
        }

        if (!Hash::check($request->password, $auth_model->password)) {
            return $this->sendError(trans("$this->module_name::auth.validations.password"));
        }

        if (!$auth_model->hasVerifiedAuth($auth_model_type)) {
            auth()->logout();
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

        return response()->json($response);
    }
}
