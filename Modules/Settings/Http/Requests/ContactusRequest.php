<?php

namespace Modules\Settings\Http\Requests;

use Modules\Accounts\Http\Requests\BaseModelRequest;

class ContactusRequest extends BaseModelRequest
{
    protected $module_name = 'settings';

    protected $additional_module_name = 'contact-us';

    protected $table = 'contact_us';


    /**
     * @return array
     */
    protected function createRules(): array
    {
        return [
            'name' => [user() ? 'nullable' : 'required', 'string', 'max:255'],
            'email' => [user() ? 'nullable' : 'required', 'email', 'max:255'],
            'phone' => [user() ? 'nullable' : 'required', 'numeric', "starts_with:$this->dial_code", 'min:10'],
            'dial_code' => [user() ? 'nullable' : 'required', "max:4", "starts_with:+"],
            'message' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * This function is called after validation passes.
     *
     * If you need to do additional validation, override this function.
     *
     * @return void
     */
    protected function additionalValidation()
    {
        //
    }
}
