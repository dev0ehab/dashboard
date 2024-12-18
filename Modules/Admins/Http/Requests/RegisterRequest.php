<?php

namespace Modules\Admins\Http\Requests;

use Modules\Accounts\Http\Requests\BaseRegisterRequest;

class RegisterRequest extends BaseRegisterRequest
{
    protected $table = 'admins';
    protected $module_name = 'admins';
    protected $additional_module_name = 'admins';



    /**
     * Get the validation rules that apply to the creation of an admin.
     *
     * Extends the parent class's create rules with additional rules specific
     * to the admin, including required role, branch, and permitted branches.
     *
     * @return array An array of validation rules.
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'branch_id' => ['required', 'exists:branches,id'],
        ]);
    }


}
