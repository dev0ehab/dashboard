<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use App\Traits\ApiTrait;
use Illuminate\Validation\Rules\Password;

class BaseRegisterRequest extends FormRequest
{
    use ApiTrait;

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
            'f_name' => ['required', 'string', 'max:255'],
            'l_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', "starts_with:$this->dial_code", 'min:10', "unique:$this->table,phone"],
            'email' => ['required', 'email', "unique:$this->table,email"],
            'dial_code' => ['required', "max:4", "starts_with:+"],
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols(), 'confirmed'],
            // 'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000'],
            'device_token' => ['required' , 'string', 'max:255'],
            'preferred_locale' => ['required' , 'string', 'max:255'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return array_merge(trans("accounts::auth.attributes"), [
            'username' => trans("accounts::auth.attributes.$this->auth_type"),
        ]);
    }

    /**
     * @param Validator $validator
     * @throws ValidationException
     */

    protected function failedValidationResponse($validator)
    {
        $response = $this->sendErrorData($validator->errors()->toArray(), $validator->errors()->first());
    }
}
