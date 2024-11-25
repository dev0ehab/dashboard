<?php

namespace Modules\Accounts\Http\Requests;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use App\Traits\ApiTrait;

class BaseModelRequest extends FormRequest
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
        $rules = $this->isMethod('POST') ? $this->createRules() : $this->updateRules();

        return RuleFactory::make($rules);
    }

    protected function createRules(): array
    {
        return [];
    }

    protected function updateRules(): array
    {
        return [];
    }


    /**
     * Run the validator's after callback.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     */
    public function withValidator(Validator $validator)
    {
        if ($validator->errors()->count() > 0) {
            throw new HttpResponseException($this->sendErrorData($validator->errors(), $validator->errors()->first()));
        }

        $validator->after(function ($validator) {

            $this->additionalValidation();

        });
    }

    /**
     * Perform additional validation checks after the primary validation.
     *
     * This function checks if a specific washer service exists and throws an
     * exception if it does not. It translates the error message and sends
     * error data back to the client in case of a validation failure.
     *
     * @throws HttpResponseException
     */
    protected function additionalValidation()
    {
        // $message = trans("error");
        // throw new HttpResponseException($this->sendErrorData(["error" => [$message]], $message));
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

        return throw new ValidationException($validator, $response);
    }
}
