<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use App\Traits\ApiTrait;

class BaseFormRequest extends FormRequest
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
        return [
            'username' => [
                'required',
                "exists:$this->table,$this->auth_type",
                $this->auth_type == 'email' ? 'email' : "starts_with:$this->dial_code",
                $this->auth_type == 'phone' ? 'min:10' : null,
            ],

            'dial_code' => [$this->auth_type == 'phone' ? 'required' : 'nullable', "max:4", "starts_with:+"],
            'password' => 'required',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        $attributes = trans("accounts::auth.attributes");

        $custom_attributes = [
            'username' => trans("accounts::auth.attributes.$this->auth_type"),
        ];

        return array_merge($attributes, $custom_attributes);
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
