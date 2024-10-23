<?php

namespace Modules\Admins\Http\Controllers\Api;

use App\Events\VerificationCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\Admins\Entities\User;
use Modules\Admins\Http\Requests\Api\RegisterRequest;
use Modules\Support\Traits\ApiTrait;

class RegisterController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    protected $class = Admin::class;

    /**
     * Handle a login request to the application.
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function register(RegisterRequest $request)
    {
        $auth_model = $this->class::create($request->validated());

        if ($request->avatar) {
            $auth_model->addMediaFromBase64($request->avatar)
                ->usingFileName('avatar.png')
                ->toMediaCollection('avatars');
        }

        event(new Registered($auth_model));
        event(new VerificationCreated($auth_model->verification));

        $data = $auth_model->getResource();
        return $this->sendResponse($data, 'success');
    }
}
