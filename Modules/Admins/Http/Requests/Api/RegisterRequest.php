<?php

namespace Modules\Admins\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Modules\Support\Traits\ApiTrait;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    use  ApiTrait;

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
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
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
        return $this->sendErrorData($validator->errors()->toArray(), 'fail');
    }
}
