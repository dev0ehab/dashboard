<?php

namespace Modules\Accounts\Http\Requests;

use DB;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use App\Traits\ApiTrait;
use Illuminate\Validation\Rules\Password;
use Modules\Accounts\Rules\PasswordRule;
use Str;

class BaseAuthModelRequest extends FormRequest
{
    use ApiTrait;

    protected $module_name;
    protected $additional_module_name;

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
        return  $this->isMethod('POST') ? $this->createRules() : $this->updateRules();
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
            'avatar' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000'],
        ];
    }

    protected function updateRules(): array
    {
        $user = DB::table($this->table)->where('id', $this->route(Str::singular($this->table)))->firstOrFail();
        return [
            'f_name' => ['sometimes', 'string', 'max:255'],
            'l_name' => ['sometimes', 'string', 'max:255'],
            'phone' => ['sometimes', "starts_with:$this->dial_code", 'min:10', "unique:$this->table,phone,$user->id"],
            'email' => ['sometimes', 'email', "unique:$this->table,email,$user->id"],
            'dial_code' => ['sometimes', "max:4", "starts_with:+"],
            'old_password' => ['required_with:password', new PasswordRule($user->password)],
            'password' => ['sometimes', Password::min(8)->letters()->mixedCase()->numbers()->symbols(), 'confirmed'],
            'avatar' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return trans("$this->module_name::$this->additional_module_name.attributes");
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
