<?php

namespace Modules\Accounts\Http\Controllers\Api;

use Modules\Accounts\Entities\Verification;
use Modules\Accounts\Events\VerificationEvent;
use Modules\Accounts\Http\Requests\BaseRegisterRequest;
use App\Traits\ApiTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseRegisterController extends BaseAuthenticationController
{
    use ApiTrait;

    protected $class;

    protected $registerRequest = BaseRegisterRequest::class;

    /**
     * Handle the registration of a new user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function register(Request $request): JsonResponse
    {
        $request_validated = $this->validationAction($this->registerRequest);

        $auth_model = $this->class::create($request_validated);

        if ($request->avatar) {
            $auth_model->addMediaFromRequest($request->avatar)
                ->usingFileName('avatar.png')
                ->toMediaCollection('avatars');
        }

        $verification = Verification::create(
            [
                'verifiable_id' => $auth_model->id,
                'verifiable_type' => $this->class,
                'verificiation_type' => get_model_auth_type($this->class),
                'verificiation_value' => $request->username,
                'code' => $code = random_int(1000, 9999),
                'created_at' => now(),
            ]
        );

        event(new VerificationEvent($verification));

        $response = [
            'success' => true,
            'data' => $auth_model->getResource(),
            'token' => $auth_model->createToken('MyApp')->plainTextToken,
            'message' => trans("$this->module_name::auth.register"),
        ];
        $response['data']['code'] = $code;
        return response()->json($response);
    }
}
