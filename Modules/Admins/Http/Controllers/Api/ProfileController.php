<?php

namespace Modules\Admins\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admins\Http\Requests\Api\ProfileRequest;
use Modules\Support\Traits\ApiTrait;

class ProfileController extends Controller
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
     * @param ProfileRequest $request
     * @return JsonResponse
     */
    public function update(ProfileRequest $request)
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

        $user->preferred_locale = $request->preferred_locale;

        $user->push();

        $data = $user->getResource();
        return $this->sendResponse($data, 'success');
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        //remove device token
        $user->update([
            'device_token' => null
        ]);

        $user->tokens()->delete();
        return $this->sendSuccess('you Have Signed Out Successfully');
    }
}
