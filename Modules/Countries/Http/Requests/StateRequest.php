<?php

namespace Modules\Countries\Http\Requests;

use DB;
use Modules\Accounts\Http\Requests\BaseModelRequest;

class StateRequest extends BaseModelRequest
{
    protected $module_name = 'countries';
    protected $additional_module_name = 'states';
    protected $table = 'countries';


    /**
     * @return array
     */
    protected function createRules(): array
    {
        return [
            'name:ar' => ['required', 'string', 'max:255', "unique:state_translations,name"],
            'name:en' => ['required', 'string', 'max:255', "unique:state_translations,name"],
            'is_active' => ['sometimes', 'boolean'],
            'country_id' => ['required', 'exists:countries,id'],
        ];
    }

    /**
     * @return array
     */
    protected function updateRules(): array
    {
        $state_translations = DB::table('state_translations')->where('state_id', $this->state)->get();
        $ar_id = $state_translations->where('locale', 'ar')->first()?->id;
        $en_id = $state_translations->where('locale', 'en')->first()?->id;

        return [
            'name:ar' => ['sometimes', 'string', 'max:255', "unique:state_translations,name,$ar_id"],
            'name:en' => ['sometimes', 'string', 'max:255', "unique:state_translations,name,$en_id"],
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
