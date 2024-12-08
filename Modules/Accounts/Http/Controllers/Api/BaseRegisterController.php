<?php

namespace Modules\Accounts\Http\Controllers\Api;

use App\Traits\CacheTrait;
use DB;
use Modules\Accounts\Entities\Verification;
use Modules\Accounts\Events\VerificationEvent;
use Modules\Accounts\Http\Requests\BaseRegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseRegisterController extends BaseController
{
    use CacheTrait;

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

        try {
            DB::beginTransaction();
            $auth_model = $this->class::create($request_validated);

            // if ($request_validated['avatar']) {
            //     $auth_model->addMediaFromRequest($request_validated['avatar'])
            //         ->usingFileName('avatar.png')
            //         ->toMediaCollection('avatars');
            // }

            $verification = Verification::create(
                [
                    'verifiable_id' => $auth_model->id,
                    'verifiable_type' => $this->class,
                    'verification_type' => get_model_auth_type($this->class),
                    'verification_value' => $request->auth_type,
                    'code' => $code =env('TEST_MODE') ? '1234' : random_int(1000, 9999),
                    'created_at' => now(),
                ]
            );

            event(new VerificationEvent($verification));

            $response = [
                'success' => true,
                'data' => $auth_model->getResource(),
                'token' => $auth_model->createToken('MyApp')->plainTextToken,
                'message' => trans("$this->module_name::auth.messages.register"),
            ];

            $response['data']['code'] = $code;

            $this->removeModelCache($this->class, $auth_model->id);

            DB::commit();
            return response()->json($response);
        } catch (\Throwable $th) {
            DB::rollBack();
            $errorData = method_exists($th, 'errors') ? $th->errors() : [];
            return $this->sendError($th->getMessage(), $errorData);
        }

    }
}
