<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Requests\Authentication\BaseProfileRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Traits\ApiTrait;

class BaseProfileController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    /**
     * Display the authenticated user resource.
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $data = auth()->user()->getResource();
        return $this->sendResponse($data, 'success');
    }

    /**
     * Update the authenticated user profile.
     *
     * @param BaseProfileRequest $request
     * @return JsonResponse
     */
    public function update(BaseProfileRequest $request)
    {
        $user = auth()->user();

        $user->update($request->validated());

        if ($request->avatar && $request->avatar != null) {
            $user->addMediaFromBase64($request->avatar)
                ->usingFileName('avatar.png')
                ->toMediaCollection('avatars');
        }

        $data = $user->getResource();
        return $this->sendResponse($data, 'success');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function preferredLocale(Request $request): JsonResponse
    {
        $user = auth()->user();

        $user->update($request->only('preferred_locale'));

        return $this->sendSuccess($user->getResource(), 'success');
    }


    public function updateFcm(Request $request)
    {
        $user = auth()->user();

        $user->update($request->only('device_token'));

        return $this->sendSuccess($user->getResource(), 'success');
    }


    public function logout(Request $request)
    {
        $user = auth()->user();

        $user->update(['device_token' => null]);

        $user->tokens()->delete();

        return $this->sendSuccess('you Have Signed Out Successfully');
    }
}
