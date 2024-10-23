<?php

namespace Modules\Admins\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Http\Requests\Api\LoginRequest;
use Modules\Support\Traits\ApiTrait;

class LoginController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    protected $class = Admin::class;

    /**
     * Handle a login request to the application.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $auth_model_type = get_model_auth_type($this->class);

        $auth_model = $this->class::where($auth_model_type, $request->username)->first();

        if (!$auth_model) {
            return $this->sendError(trans('admins::auth.failed'));
        }

        if ($auth_model->blocked_at) {
            auth()->logout();
            return $this->sendError(trans('admins::auth.blocked'));
        }

        if (!Hash::check($request->password, $auth_model->password)) {
            return $this->sendError(trans('admins::users.messages.password'));
        }

        if (!$auth_model->hasVerifiedEmail()) {
            auth()->logout();
            // $auth_model->sendVerificationCode(request('test_mode'));
            $data = $auth_model->getResource();
            return $this->sendResponse($data, trans('admins::users.messages.verified'));
        }

        event(new Login('sanctum', $auth_model, false));

        $auth_model->last_login_at = Carbon::now()->toDateTimeString();
        $auth_model->preferred_locale = $request->preferred_locale ?? app()->getLocale();

        if ($auth_model->device_token === null || $auth_model->device_token != $request->device_token) {
            $auth_model->device_token = $request->device_token;
        }

        $auth_model->push();

        $response = [
            'success' => true,
            'data' => $auth_model->getResource(),
            'token' => $auth_model->createToken('MyApp')->plainTextToken,
            'message' => 'success',
        ];

        return response()->json($response);
    }
}
