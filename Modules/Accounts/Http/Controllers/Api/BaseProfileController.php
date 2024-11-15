<?php

namespace Modules\Accounts\Http\Controllers\Api;

use Modules\Accounts\Events\ChangePasswordEvent;
use Modules\Accounts\Http\Requests\BasePasswordRequest;
use Modules\Accounts\Http\Requests\BaseProfileDeleteRequest;
use Modules\Accounts\Http\Requests\BaseProfileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseProfileController extends BaseController
{

    protected $profileRequest = BaseProfileRequest::class;
    protected $passwordRequest = BasePasswordRequest::class;
    protected $deleteRequest = BaseProfileDeleteRequest::class;

    /**
     * Display the authenticated user resource.
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $data = auth()->user()->getResource();
        return $this->sendResponse($data, trans("messages.success"));
    }


    public function update(Request $request): JsonResponse
    {
        $data = $this->validationAction($this->profileRequest);

        $auth_model = auth()->user();

        $auth_model->update($data);

        if ($request->avatar && $request->avatar != null) {
            $auth_model->addMedia($request->avatar)
                ->usingFileName('avatar.png')
                ->toMediaCollection('avatars');
        }

        $data = $auth_model->getResource();
        return $this->sendResponse($data, trans("$this->module_name::auth.messages.profile.update"));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function preferredLocale(Request $request): JsonResponse
    {
        $auth_model = auth()->user();

        $auth_model->update($request->only('preferred_locale'));

        return $this->sendSuccess(trans("$this->module_name::auth.messages.profile.preferred-locale"));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function password(Request $request): JsonResponse
    {
        $this->validationAction($this->passwordRequest);

        $auth_model = auth()->user();

        $auth_model->update($request->only('password'));

        event(new ChangePasswordEvent((string) get_class($auth_model), (string) $auth_model->id, (string) $request->password));

        return $this->sendSuccess(trans("$this->module_name::auth.messages.profile.preferred-locale"));
    }


    /**
     * Update the authenticated user's FCM device token.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function fcm(Request $request): JsonResponse
    {
        $auth_model = auth()->user();

        $auth_model->update($request->only('device_token'));

        return $this->sendSuccess(trans("$this->module_name::auth.messages.notification"));
    }


    /**
     * Logs out the authenticated user.
     *
     * This method clears the user's FCM device token and revokes all personal access tokens.
     *
     * @return JsonResponse A response indicating success or failure.
     */
    public function logout(): JsonResponse
    {
        $auth_model = auth()->user();

        $auth_model->update(['device_token' => null]);

        $auth_model->tokens()->delete();

        return $this->sendSuccess(trans("$this->module_name::auth.messages.logout"));
    }

    /**
     * Deletes the authenticated user account.
     *
     * This method deletes the user permanently from the database and revokes all personal access tokens.
     *
     * @return JsonResponse A response indicating success or failure.
     */
    public function delete(Request $request): JsonResponse
    {
        $this->validationAction($this->deleteRequest);

        auth()->user()->delete();

        return $this->sendSuccess(trans("$this->module_name::auth.messages.deleted"));
    }
}
