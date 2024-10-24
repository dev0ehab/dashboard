<?php

namespace App\Http\Controllers\Authentication;

use App\Events\VerificationCreated;
use App\Models\Verification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use App\Traits\ApiTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Requests\Authentication\BaseVerificationRequest;
use App\Http\Requests\Authentication\BaseVerifyRequest;

class BaseChangeAuthenticable extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    protected $class = Authenticatable::class;
    protected $path = '';

    public function __construct()
    {

    }


    public function send(BaseVerifyRequest $request)
    {
        $auth_model = auth()->user();

        $verification = Verification::updateOrCreate(
            [
                'verifiable_id' => $auth_model->id,
                'verifiable_type' => $this->class,
                'verficiation_type' => get_model_auth_type($this->class),
                'verficiation_value' => $request->username
            ],
            [
                'code' => $code = random_int(1000, 9999),
                'created_at' => now(),
            ]
        );

        event(new VerificationCreated($verification));

        $data['code'] = $code;

        return $this->sendResponse($data, trans('accounts::verification.sent'));
    }

    public function verify(BaseVerificationRequest $request)
    {
        $auth_model = auth()->user();

        $verification = Verification::where([
            'verifiable_id' => $auth_model->id,
            'verifiable_type' => $this->class,
            'verficiation_type' => $auth_type = get_model_auth_type($this->class),
            'verficiation_value' => $request->username
        ])->first();

        if (!$verification || $verification->isExpired()) {
            return $this->sendError(trans('accounts::verification.invalid'));
        }

        $auth_model->forceFill([
            $auth_type => $verification->username,
        ])->save();

        $verification->delete();

        $data = $auth_model->getResource();

        return $this->sendResponse($data, __('Phone updated successfully.'));
    }
}
