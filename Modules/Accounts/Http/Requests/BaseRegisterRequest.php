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
            'email' => ['nullable', 'email', "unique:$this->table,email"],
            'phone' => ['required', "unique:$this->table,phone"],
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
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
