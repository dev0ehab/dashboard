<?php

namespace Modules\Branches\Http\Requests;

use DB;
use Modules\Accounts\Http\Requests\BaseModelRequest;

class BranchRequest extends BaseModelRequest
{
    protected $module_name = 'branches';
    protected $additional_module_name = 'branches';
    protected $table = 'branches';


    /**
     * @return array
     */
    protected function createRules(): array
    {
        return [
            'name:ar' => ['required', 'string', 'max:255', "unique:branch_translations,name"],
            'name:en' => ['required', 'string', 'max:255', "unique:branch_translations,name"],
            'country_id' => ['required', 'exists:countries,id,is_active,1'],
            'address' => ['required', 'string', 'max:255'],
            'lat' => ['required', 'numeric', 'string', 'max:255'],
            'long' => ['required', 'numeric', 'string', 'max:255'],

            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * @return array
     */
    protected function updateRules(): array
    {
        $branch_translations = DB::table('branch_translations')->where('branch_id', $this->branch)->get();
        $ar_id = $branch_translations->where('locale', 'ar')->first()?->id;
        $en_id = $branch_translations->where('locale', 'en')->first()?->id;

        return [
            'name:ar' => ['sometimes', 'string', 'max:255', "unique:branch_translations,name,$ar_id"],
            'name:en' => ['sometimes', 'string', 'max:255', "unique:branch_translations,name,$en_id"],

            'address' => ['sometimes', 'string', 'max:255'],
            'lat' => ['sometimes', 'numeric', 'string', 'max:255'],
            'long' => ['sometimes', 'numeric', 'string', 'max:255'],

            'country_id' => ['sometimes', 'exists:countries,id,is_active,1' ],

            'is_active' => ['sometimes', 'boolean'],
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
