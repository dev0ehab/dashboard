<?php

namespace Modules\Roles\Http\Requests;

use DB;
use Modules\Accounts\Http\Requests\BaseModelRequest;

class RoleRequest extends BaseModelRequest
{
    protected $module_name = 'roles';
    protected $table = 'roles';


    /**
     * @return array
     */
    protected function createRules(): array
    {
        return [
            'display_name:ar' => ['required', 'string', 'max:255', "unique:role_translations,display_name"],
            'display_name:en' => ['required', 'string', 'max:255', "unique:role_translations,display_name"],
            "permissions" => ['required', 'array'],
            "permissions.*" => ['sometimes', 'exists:permissions,id'],
        ];
    }

    /**
     * @return array
     */
    protected function updateRules(): array
    {
        $role_translations = DB::table('role_translations')->where('role_id', $this->role)->get();
        $ar_id = $role_translations->where('locale', 'ar')->first()?->id;
        $en_id = $role_translations->where('locale', 'en')->first()?->id;

        return [
            'display_name:ar' => ['required', 'string', 'max:255', "unique:role_translations,display_name,$ar_id"],
            'display_name:en' => ['required', 'string', 'max:255', "unique:role_translations,display_name,$en_id"],
            "permissions" => ['nullable', 'array'],
            "permissions.*" => ['sometimes', 'exists:permissions,id'],
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
