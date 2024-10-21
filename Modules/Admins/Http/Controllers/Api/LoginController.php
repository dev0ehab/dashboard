<?php

namespace Modules\Admins\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Admins\Entities\User;
use Modules\Admins\Http\Requests\Api\LoginRequest;
use Modules\Support\Traits\ApiTrait;

class LoginController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    /**
     * Handle a login request to the application.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $user = User::where(function (Builder $query) use ($request) {
            $query->where('email', $request->username);
            $query->orWhere('phone', $request->username);
        })->first();

        if (!$user) {
            return $this->sendError(trans('admins::auth.failed'));
        }

        if ($user->blocked_at) {
            auth()->logout();
            return $this->sendError(trans('admins::auth.blocked'));
        }

        if (!Hash::check($request->password, $user->password)) {
            return $this->sendError(trans('admins::users.messages.password'));
        }

        if (!$user->hasVerifiedEmail()) {
            auth()->logout();
            $user->sendVerificationCode(request('test_mode'));
            $data = $user->getResource();
            return $this->sendResponse($data, trans('admins::users.messages.verified'));
        }

        event(new Login('sanctum', $user, false));

        $user->last_login_at = Carbon::now()->toDateTimeString();
        $user->preferred_locale = $request->preferred_locale ?? app()->getLocale();

        if ($user->device_token === null || $user->device_token != $request->device_token) {
            $user->device_token = $request->device_token;
        }

        $user->push();

        $data = $user->getResource();
        return $this->sendResponse($data, 'success');
    }
}
