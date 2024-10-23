<?php

namespace Modules\Admins\Http\Controllers\Api;

use App\Events\VerificationCreated;
use App\Models\Verification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Http\Requests\Api\VerificationRequest;
use Modules\Admins\Http\Requests\Api\VerifyRequest;
use Modules\Support\Traits\ApiTrait;

class VerificationController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    protected $class = Admin::class;

    /**
     * Send or resend the verification code.
     *
     * @param VerifyRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function send(VerifyRequest $request): JsonResponse
    {
        $auth_model_type = get_model_auth_type($this->class);
        $auth_model = $this->class::where($auth_model_type, $request->username)->first();


        if (!$auth_model) {
            return $this->sendError(trans('admins::auth.failed'));
        }

        event(new VerificationCreated($auth_model));

        return response()->json([
            'code' => request('verification_code'),
            'message' => trans('admins::verification.sent'),
        ]);
    }

    /**
     * Verify the user's phone number.
     *
     * @param VerificationRequest $request
     * @return JsonResponse
     */
    public function verify(VerificationRequest $request): JsonResponse
    {
        $auth_model_type = get_model_auth_type($this->class);
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
