<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use App\Traits\ApiTrait;
use Modules\Accounts\Rules\PasswordRule;

class BaseProfileRequest extends FormRequest
{
    use ApiTrait;
    protected $table;
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
        $user = auth()->user();
        return [
            'f_name' => ['sometimes', 'string', 'max:255'],
            'l_name' => ['sometimes', 'string', 'max:255'],
            'avatar' => ['sometimes', 'image', 'max:10000'],

            'phone' => ['sometimes', "starts_with:$this->dial_code", 'min:10', "unique:$this->table,phone,$user->id"],
            'email' => ['sometimes', 'email', "unique:$this->table,email,$user->id"],
            'dial_code' => ['sometimes', "max:4", "starts_with:+"],

            'old_password' => ['required_with:password', new PasswordRule($user->password)],
            'password' => ['sometimes', Password::min(8)->letters()->mixedCase()->numbers()->symbols(), 'confirmed'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
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
