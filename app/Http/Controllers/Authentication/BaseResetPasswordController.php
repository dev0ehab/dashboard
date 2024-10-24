<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Requests\Authentication\BaseForgetPasswordRequest;
use App\Http\Requests\Authentication\BaseResetPasswordCodeRequest;
use App\Http\Requests\Authentication\BaseResetPasswordRequest;
use App\Models\ResetPasswordCode;
use App\Models\ResetPasswordToken;
use Exception;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use App\Events\ResetPasswordCreated;
use App\Traits\ApiTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BaseResetPasswordController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    protected $class = Authenticatable::class;

    /**
     * Send forget password code to the user.
     *
     * @param BaseForgetPasswordRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function forget(BaseForgetPasswordRequest $request): JsonResponse
    {
        $auth_model_type = $request->auth_type;
        $auth_model = $this->class::where($auth_model_type, $request->username)->first();

        if (!$auth_model) {
            return $this->sendError(trans('admins::auth.failed'));
        }

        $resetPasswordCode = ResetPasswordCode::updateOrCreate([
            'resetable_id' => $auth_model->id,
            'resetable_type' => get_class($auth_model),
            'reset_type' => get_model_auth_type($auth_model),
            'reset_value' => $request->username,
        ], [
            'code' => $code = random_int(1000, 9999),
            'created_at' => now(),
        ]);

        event(new ResetPasswordCreated($resetPasswordCode));

        $data['reset_password_code'] = $code;

        return $this->sendResponse($data, trans('admins::auth.messages.forget-password-code-sent'));
    }

    /**
     * Get the reset password token using verification code.
     *
     * @param BaseResetPasswordCodeRequest $request
     * @return JsonResponse
     */
    public function code(BaseResetPasswordCodeRequest $request): JsonResponse
    {
        $auth_model_type = $request->auth_type;
        $auth_model = $this->class::where($auth_model_type, $request->username)->first();

        $dataReset = [
            'resetable_id' => $auth_model->id,
            'resetable_type' => $this->class,
            'reset_type' => get_model_auth_type($this->class),
            'reset_value' => $request->username,
            'code' => $request->code,
        ];

        $resetPasswordCode = ResetPasswordCode::where($dataReset)->first();

        if (!$resetPasswordCode || $resetPasswordCode->isExpired() || !$auth_model) {
            return $this->sendError(trans('validation.exists', [
                'attribute' => trans('admins::auth.attributes.code'),
            ]));
        }

        ResetPasswordCode::where(['resetable_id' => $auth_model->id, 'resetable_type' => get_class($auth_model)])->delete();

        ResetPasswordToken::updateOrCreate([
            'resetable_id' => $auth_model->id,
            'resetable_type' => $this->class,
            'reset_type' => get_model_auth_type($this->class),
            'reset_value' => $request->username,
        ], [
            'token' => $token = Str::random(80),
            'created_at' => now(),
        ]);

        $data['reset_token'] = $token;

        return $this->sendResponse($data, 'success');
    }

    /**
     * @param BaseResetPasswordRequest $request
     * @return JsonResponse
     */
    public function reset(BaseResetPasswordRequest $request): JsonResponse
    {
        $dataReset = [
            'resetable_type' => $this->class,
            'reset_type' => get_model_auth_type($this->class),
            'token' => $request->token,
        ];

        $resetPasswordToken = ResetPasswordToken::where($dataReset)->latest()->first();

        if (!$resetPasswordToken || $resetPasswordToken->isExpired()) {
            return $this->sendError(trans('validation.exists', [
                'attribute' => trans('admins::auth.attributes.token'),
            ]));
        }

        $auth_model = $resetPasswordToken->resetable;

        $auth_model->update([
            'password' => $request->password,
        ]);

        event(new Login('sanctum', $auth_model, false));

        ResetPasswordToken::where(['resetable_id' => $auth_model->id, 'resetable_type' => get_class($auth_model)])->delete();

        return $this->sendSuccess('success');
    }
}
