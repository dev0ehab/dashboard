<?php

namespace App\Http\Controllers\Authentication;

use App\Events\VerificationCreated;
use App\Http\Requests\Authentication\BaseRegisterRequest;
use App\Traits\ApiTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseRegisterController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    protected $class = Authenticatable::class;

    /**
     * Register a new user and return a token for the user.
     *
     * @param BaseRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(BaseRegisterRequest $request)
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
            'message' => 'success',
        ];

        return response()->json($response);
    }
}
