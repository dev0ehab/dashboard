<?php

namespace App\Http\Controllers\Authentication;

use App\Events\VerificationCreated;
use App\Http\Requests\Authentication\BaseRegisterRequest;
use App\Traits\ApiTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class BaseRegisterController extends BaseAuthenticationController
{
    use  ApiTrait;

    protected $class;

    protected $registerRequest = BaseRegisterRequest::class ;

/**
 * Handle the registration of a new user.
 *
 * @param Request $request
 * @return \Illuminate\Http\JsonResponse
 *
 * This method creates a new user based on the validated request data.
 * If an avatar is provided in the request, it is added to the user's media collection.
 * It triggers a Registered event and a VerificationCreated event for the new user.
 * Returns a JSON response containing the user's resource data, an access token, and a success message.
 */
    public function register(Request $request)
    {
        $auth_model = $this->class::create($request->validated());

        if ($request->avatar) {
            $auth_model->addMediaFromBase64($request->avatar)
                ->usingFileName('avatar.png')
                ->toMediaCollection('avatars');
        }

        event(new Registered($auth_model));
        event(new VerificationCreated($auth_model->verification));

        $response = [
            'success' => true,
            'data' => $auth_model->getResource(),
            'token' => $auth_model->createToken('MyApp')->plainTextToken,
            'message' => trans("$this->module_name::auth.register"),
        ];

        return response()->json($response);
    }
}
