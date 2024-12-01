<?php

namespace Modules\Admins\Http\Requests;

use Modules\Accounts\Http\Requests\BaseAuthModelRequest;

class AdminRequest extends BaseAuthModelRequest
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
    protected function createRules(): array
    {
        return array_merge(parent::createRules(), [
            'role_id' => ['required', 'exists:roles,id'],
            'branch_id' => ['required', 'exists:branches,id'],
            'permitted_branches' => ['required', 'exists:branches,id'],
        ]);
    }


    /**
     * Get the validation rules that apply to the updating of an admin.
     *
     * Extends the parent class's update rules with additional rules specific
     * to the admin, allowing modifications to role, branch, and permitted branches.
     *
     * @return array An array of validation rules.
     */
    protected function updateRules(): array
    {
        return array_merge(parent::updateRules(), [
            'role_id' => ['sometimes', 'exists:roles,id'],
            'branch_id' => ['sometimes', 'exists:branches,id'],
            'permitted_branches' => ['sometimes', 'exists:branches,id'],
        ]);
    }
}
