<?php

namespace Modules\Roles\Http\Requests;

use Modules\Accounts\Http\Requests\BaseModelRequest;

class RoleRequest extends BaseModelRequest
{
    protected $module_name = 'roles';
    protected $table = 'roles';


    protected function createRules(): array
    {
        return [
            'display_name:ar' => ['required', 'string', 'max:255', "unique:role_translations,display_name"],
            'display_name:en' => ['required', 'string', 'max:255', "unique:role_translations,display_name"],
            "permissions" => ['required', 'array'],
        ];
    }

    protected function updateRules(): array
    {
        return [
            'display_name:ar' => ['required', 'string', 'max:255', "unique:role_translations,display_name"],
            'display_name:en' => ['required', 'string', 'max:255', "unique:role_translations,display_name"],
            "permissions" => ['required', 'array'],
        ];
    }


    protected function additionalValidation()
    {
        // $message = trans("error");
        // throw new HttpResponseException($this->sendErrorData(["error" => [$message]], $message));
    }
}
