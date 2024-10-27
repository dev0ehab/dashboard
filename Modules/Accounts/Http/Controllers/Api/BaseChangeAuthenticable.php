<?php

namespace Modules\Accounts\Http\Controllers\Api;

use Modules\Accounts\Events\VerificationEvent;
use Modules\Accounts\Http\Requests\BaseVerificationRequest;
use Modules\Accounts\Http\Requests\BaseVerifyRequest;
use Modules\Accounts\Entities\Verification;
use App\Traits\ApiTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseChangeAuthenticable extends BaseAuthenticationController
{
    use ApiTrait;

    protected $sendRequest = BaseVerifyRequest::class;

    protected $verifyRequest = BaseVerificationRequest::class;

    /**
     * Send verification code to the user's new phone number or email.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function send(Request $request): JsonResponse
    {
        $this->validationAction($this->sendRequest, $request);

        $auth_model = auth()->user();

        $verification = Verification::updateOrCreate(
            [
                'verifiable_id' => $auth_model->id,
                'verifiable_type' => $this->class,
                'verificiation_type' => $auth_type = get_model_auth_type($this->class),
                'verificiation_value' => $request->username
            ],
            [
                'code' => $code = random_int(1000, 9999),
                'created_at' => now(),
            ]
        );

        event(new VerificationEvent($verification));

        $data['code'] = $code;

        return $this->sendResponse($data, trans("$this->module_name::auth.change-authenticable.$auth_type.sent"));
    }

    /**
     * Verify the user's new phone number or email.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function verify(Request $request): JsonResponse
    {
        $this->validationAction($this->verifyRequest, $request);

        $auth_model = auth()->user();

        $verification = Verification::where([
            'verifiable_id' => $auth_model->id,
            'verifiable_type' => $this->class,
            'verificiation_type' => $auth_type = get_model_auth_type($this->class),
            'verificiation_value' => $request->username
        ])->first();

        if (!$verification || $verification->isExpired()) {
            return $this->sendError(trans("$this->module_name::auth.validations.verification", [
                'attribute' => trans("$this->module_name::auth.attributes.code"),
            ]));
        }

        $auth_model_updates[$auth_type] = $verification->username;
        $auth_model_updates['dial_code'] = $auth_type == 'phone' ? $request->dial_code : null;
        $auth_model->forceFill($auth_model_updates)->save();

        $verification->delete();

        $data = $auth_model->getResource();

        return $this->sendResponse($data, trans("$this->module_name::auth.change-authenticable.$auth_type.verify"));
    }
}
