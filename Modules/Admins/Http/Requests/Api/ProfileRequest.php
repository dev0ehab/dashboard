<?php

namespace Modules\Admins\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Modules\Admins\Entities\User;
use Modules\Admins\Http\Requests\WithHashedPassword;
use Modules\Support\Traits\ApiTrait;

class ProfileRequest extends FormRequest
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
            'email' => ['nullable', 'email', 'unique:users,email,' . auth()->id()],
            'phone' => ['required', 'unique:users,phone,' . auth()->id()],
//            'old_password' => ['required_with:password', new PasswordRule(auth()->user()->password ?? 'password')],
//            'password' => ['nullable', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'base64_image'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        switch (auth()->user()->type) {
            case User::ADMIN_TYPE:
                return trans('admins::admins.attributes');
                break;
            case User::CUSTOMER_TYPE:
            default:
                return trans('admins::customers.attributes');
                break;
        }
    }

    /**
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = $this->sendErrorData($validator->errors()->toArray(), 'fail');

        throw new ValidationException($validator, $response);
    }
}
