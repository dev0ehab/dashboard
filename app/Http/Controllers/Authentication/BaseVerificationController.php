<?php

namespace App\Http\Controllers\Authentication;

use App\Events\VerificationCreated;
use App\Http\Requests\Authentication\BaseVerificationRequest;
use App\Http\Requests\Authentication\BaseVerifyRequest;
use App\Models\Verification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use App\Traits\ApiTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BaseVerificationController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    protected $class = Authenticatable::class;

    public function __construct() {
        $this->sendRequest = \Modules\Admins\Http\Requests\VerifyRequest::class;
    }

    /**
     * Send or resend the verification code.
     *
     * @param BaseVerifyRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function send(BaseVerifyRequest $request): JsonResponse
    {
        $auth_model_type = $request->auth_type;
        $auth_model = $this->class::where($auth_model_type, $request->username)->first();

        if (!$auth_model) {

            if (request()->has('force_verify') && request()->get('force_verify') == 1) {
                $auth_model = $this->class::forceCreate([$auth_model_type => $request->username]);
            } else {
                return $this->sendError(trans('admins::auth.failed'));
            }

        }

        $verification = Verification::updateOrCreate(
            [
                'verifiable_id' => $auth_model->id,
                'verifiable_type' => $this->class,
                'verficiation_type' => get_model_auth_type($this->class),
                'verficiation_value' => $request->username
            ],
            [
                'code' => $code = random_int(1000, 9999),
                'created_at' => now(),
            ]
        );

        event(new VerificationCreated($verification));

        $data['code'] = $code;

        return $this->sendResponse($data, trans('admins::auth.messages.forget-password-code-sent'));

    }

    /**
     * Verify the user's Auth Type .
     *
     * @param BaseVerificationRequest $request
     * @return JsonResponse
     */
    public function verify(BaseVerificationRequest $request): JsonResponse
    {
        $auth_model_type = $request->auth_type;
        $auth_model = $this->class::where($auth_model_type, $request->username)->first();

        if (!$auth_model) {
            return $this->sendError(trans('admins::auth.failed'));
        }

        $verification = Verification::where([
            'verifiable_id' => $auth_model->id,
            'verifiable_type' => $this->class,
            'verficiation_type' => get_model_auth_type($this->class),
            'verficiation_value' => $request->username,
            'code' => $request->code,
        ])->first();

        if (!$verification || $verification->isExpired()) {
            return $this->sendError(trans('admins::verification.invalid'));
        }

        $auth_model->forceFill([
            $auth_model_type => $verification->phone,
            "{$auth_model_type}_verified_at" => now(),
        ])->save();

        $verification->delete();

        $data = $auth_model->getResource();

        $data['token'] = $auth_model->createTokenForDevice($request->device_name);

        return $this->sendResponse($data, trans('admins::verification.is_verified'));
    }
}
