<?php

namespace App\Http\Controllers\Authentication;

use App\Events\VerificationCreated;
use App\Http\Requests\Authentication\BaseVerificationRequest;
use App\Http\Requests\Authentication\BaseVerifyRequest;
use App\Models\Verification;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class BaseVerificationController extends BaseAuthenticationController
{
    use ApiTrait;

    protected $class;

    protected $sendRequest = BaseVerifyRequest::class;

    protected $verifyRequest = BaseVerificationRequest::class;

    public function send(Request $request)
    {
        $this->validationAction($this->sendRequest, $request);

        $auth_model_type = $request->auth_type;

        $auth_model = $this->class::where($auth_model_type, $request->username)->first();

        if (!$auth_model) {

            if (request()->has('force_verify') && request()->get('force_verify') == 1) {
                $auth_model = $this->class::forceCreate([$auth_model_type => $request->username]);
            } else {
                return $this->sendError(trans("$this->module_name::auth.validations.failed"));
            }
        }

        $verification = Verification::updateOrCreate(
            [
                'verifiable_id' => $auth_model->id,
                'verifiable_type' => $this->class,
                'verificiation_type' => get_model_auth_type($this->class),
                'verificiation_value' => $request->username
            ],
            [
                'code' => $code = random_int(1000, 9999),
                'created_at' => now(),
            ]
        );

        event(new VerificationCreated($verification));

        $data['code'] = $code;

        return $this->sendResponse($data, trans("$this->module_name::auth.messages.verification.sent"));
    }

    /**
     * Verify the user's Auth Type .
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function verify(Request $request): JsonResponse
    {
        $this->validationAction($this->verifyRequest, $request);

        $auth_model_type = $request->auth_type;
        $auth_model = $this->class::where($auth_model_type, $request->username)->first();

        if (!$auth_model) {
            return $this->sendError(trans('admins::auth.failed'));
        }

        $verification = Verification::where([
            'verifiable_id' => $auth_model->id,
            'verifiable_type' => $this->class,
            'verificiation_type' => get_model_auth_type($this->class),
            'verificiation_value' => $request->username,
            'code' => $request->code,
        ])->first();

        if (!$verification || $verification->isExpired()) {
            return $this->sendError(trans("$this->module_name::auth.verifications.verification", [
                'attribute' => trans("$this->module_name::auth.attributes.code"),
            ]));
        }

        $auth_model->forceFill([
            $auth_model_type => $verification->phone,
            "{$auth_model_type}_verified_at" => now(),
        ])->save();

        $verification->delete();

        $data = $auth_model->getResource();

        $data['token'] = $auth_model->createTokenForDevice($request->device_name);

        return $this->sendResponse($data, trans("$this->module_name::auth.messages.verification.verified"));
    }
}
