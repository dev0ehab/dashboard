<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Requests\Authentication\BaseProfileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ApiTrait;

class BaseProfileController extends BaseAuthenticationController
{
    use ApiTrait;

    protected $profileRequest = BaseProfileRequest::class;

    /**
     * Display the authenticated user resource.
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $data = auth()->user()->getResource();
        return $this->sendResponse($data, trans("successful request"));
    }


    public function update(Request $request)
    {
        $this->validationAction($this->profileRequest, $request);

        $user = auth()->user();

        $user->update($request->validated());

        if ($request->avatar && $request->avatar != null) {
            $user->addMediaFromBase64($request->avatar)
                ->usingFileName('avatar.png')
                ->toMediaCollection('avatars');
        }

        $data = $user->getResource();
        return $this->sendResponse($data, trans("$this->module_name::auth.messages.profile.update"));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function preferredLocale(Request $request): JsonResponse
    {
        $user = auth()->user();

        $user->update($request->only('preferred_locale'));

        return $this->sendSuccess($user->getResource(), trans("$this->module_name::auth.messages.profile.preferred-locale"));
    }


    /**
     * Update the authenticated user's FCM device token.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateFcm(Request $request)
    {
        $user = auth()->user();

        $user->update($request->only('device_token'));

        return $this->sendSuccess($user->getResource(), trans("successful request"));
    }


    /**
     * Logs out the authenticated user.
     *
     * This method clears the user's FCM device token and revokes all personal access tokens.
     *
     * @return JsonResponse A response indicating success or failure.
     */
    public function logout()
    {
        $user = auth()->user();

        $user->update(['device_token' => null]);

        $user->tokens()->delete();

        return $this->sendSuccess(trans("$this->module_name::auth.messages.logout"));
    }
}
