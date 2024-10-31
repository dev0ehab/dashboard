<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use App\Traits\ApiTrait;
use Illuminate\Validation\Rules\Password;

class BaseAuthModelRequest extends FormRequest
{
    use ApiTrait;

    /**
     * Determine if the supervisor is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if ($this->isMethod('POST')) {
            return $this->createRules();
        }
        return $this->updateRules();
    }

    protected function createRules(): array
    {
        return [
            'f_name' => ['required', 'string', 'max:255'],
            'l_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', "starts_with:$this->dial_code", 'min:10', "unique:$this->table,phone"],
            'email' => ['required', 'email', "unique:$this->table,email"],
            'dial_code' => ['required', "max:4", "starts_with:+"],
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols(), 'confirmed'],
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000'],
        ];
    }

    protected function updateRules(): array
    {
        return [
            'f_name' => ['nullable', 'string', 'max:255'],
            'l_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', "starts_with:$this->dial_code", 'min:10', "unique:$this->table,phone"],
            'email' => ['nullable', 'email', "unique:$this->table,email"],
            'dial_code' => ['nullable', "max:4", "starts_with:+"],
            'password' => ['nullable', Password::min(8)->letters()->mixedCase()->numbers()->symbols(), 'confirmed'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return trans("accounts::auth.attributes");
    }

    /**
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = $this->sendErrorData($validator->errors()->toArray(), $validator->errors()->first());

        throw new ValidationException($validator, $response);
    }
}