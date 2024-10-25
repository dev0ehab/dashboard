<?php

namespace App\Http\Controllers\Authentication;

use App\Models\ResetPasswordCode;
use App\Models\ResetPasswordToken;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Events\ResetPasswordCreated;
use App\Http\Requests\Authentication\BaseResetPasswordRequest;
use App\Http\Requests\Authentication\BaseResetPasswordSendRequest;
use App\Http\Requests\Authentication\BaseResetPasswordVerifyRequest;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class BaseResetPasswordController extends BaseAuthenticationController
{
    use ApiTrait;

    protected $class;

    protected $sendRequest = BaseResetPasswordSendRequest::class;

    protected $verifyRequest = BaseResetPasswordVerifyRequest::class;

    protected $resetRequest = BaseResetPasswordRequest::class;

    /**
     * Handle the process of forgetting a password by generating and sending a reset code.
     *
     * This method verifies if the user exists based on the provided authentication type and username.
     * If the user exists, it generates a new reset password code and triggers the ResetPasswordCreated event.
     *
     * @param Request $request The request containing the authentication type and username.
     * @return JsonResponse A response indicating success or failure in sending the reset password code.
     */
    public function send(Request $request): JsonResponse
    {
        $this->validationAction($this->sendRequest, $request);

        $auth_model_type = $request->auth_type;
        $auth_model = $this->class::where($auth_model_type, $request->username)->first();

        if (!$auth_model) {
            return $this->sendError(trans("$this->module_name::auth.validations.failed"));
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

        return $this->sendResponse($data, trans("$this->module_name::auth.messages.password-reset.sent"));

        trans("$this->module_name::auth.messages.password-reset.sent");
        trans("$this->module_name::auth.messages.password-reset.verified");
        trans("$this->module_name::auth.messages.password-reset.reset");
    }



    /**
     * Validate the reset password code.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function code(Request $request): JsonResponse
    {
        $this->validationAction($this->verifyRequest, $request);

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
            return $this->sendError(trans("$this->module_name::auth.verifications.verification", [
                'attribute' => trans("$this->module_name::auth.attributes.code"),
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

        return $this->sendResponse($data, trans("$this->module_name::auth.messages.password-reset.verified"));
    }

    /**
     * Reset the password for the user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function reset(Request $request): JsonResponse
    {
        $this->validationAction($this->resetRequest, $request);

        $dataReset = [
            'resetable_type' => $this->class,
            'reset_type' => get_model_auth_type($this->class),
            'token' => $request->token,
        ];

        $resetPasswordToken = ResetPasswordToken::where($dataReset)->latest()->first();

        if (!$resetPasswordToken || $resetPasswordToken->isExpired()) {
            return $this->sendError(trans("$this->module_name::auth.validations.validation-exists", [
                'attribute' => trans("$this->module_name::auth.attributes.token"),
            ]));
        }

        $auth_model = $resetPasswordToken->resetable;

        $auth_model->update([
            'password' => $request->password,
        ]);

        event(new Login('sanctum', $auth_model, false));

        ResetPasswordToken::where(['resetable_id' => $auth_model->id, 'resetable_type' => get_class($auth_model)])->delete();

        return $this->sendSuccess(trans("$this->module_name::auth.messages.password-reset.reset"));
    }
}
