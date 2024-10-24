<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Traits\ApiTrait;

class BaseVerifyRequest extends FormRequest
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

            'username' => [
                'required',
                $this->force_verify ? "exists:$this->table,$this->auth_type" : null,
                $this->auth_type == 'email' ? 'email' : "starts_with:$this->dial_code",
                $this->auth_type == 'phone' ? 'min:10' : null,
            ],

            'dial_code' => [$this->auth_type == 'phone' ? 'required' : 'nullable', "max:4", "starts_with:+"],
        ];

    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans("$this->table::verification.attributes");
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
