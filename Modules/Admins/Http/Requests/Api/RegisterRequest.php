<?php

namespace Modules\Admins\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Modules\Admins\Entities\Customer;
use Modules\Admins\Http\Requests\WithHashedPassword;
use Modules\Support\Traits\ApiTrait;

class RegisterRequest extends FormRequest
{
    use WithHashedPassword, ApiTrait;

    /**
     * Determine if the supervisor is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'unique:users,email'],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required', 'min:6'],
            'avatar' => ['nullable', 'base64_image'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return trans('admins::customers.attributes');
    }

    /**
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, $this->failedValidationResponse($validator));
    }

    private function failedValidationResponse($validator)
    {
        $user = Customer::inRequest(request())->first();

        if ($user) {
            if (!$user->hasVerifiedEmail()) {
                $user->sendVerificationCode(request('test_mode'));
                $data = $user->getResource();
                return $this->sendResponse($data, trans('admins::users.messages.verified'));
            }
        }

        return $this->sendErrorData($validator->errors()->toArray(), 'fail');
    }
}
