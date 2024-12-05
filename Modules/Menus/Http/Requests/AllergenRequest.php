<?php

namespace Modules\Menus\Http\Requests;

use DB;
use Modules\Accounts\Http\Requests\BaseModelRequest;

class AllergenRequest extends BaseModelRequest
{
    protected $module_name = 'menus';
    protected $additional_module_name = 'allergens';
    protected $table = 'allergens';


    /**
     * @return array
     */
    protected function createRules(): array
    {
        return [
            'name:ar' => ['required', 'string', 'max:255', "unique:allergen_translations,name"],
            'name:en' => ['required', 'string', 'max:255', "unique:allergen_translations,name"],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * @return array
     */
    protected function updateRules(): array
    {
        $allergen_translations = DB::table('allergen_translations')->where('allergen_id', $this->allergen)->get();
        $ar_id = $allergen_translations->where('locale', 'ar')->first()?->id;
        $en_id = $allergen_translations->where('locale', 'en')->first()?->id;

        return [
            'name:ar' => ['sometimes', 'string', 'max:255', "unique:allergen_translations,name,$ar_id"],
            'name:en' => ['sometimes', 'string', 'max:255', "unique:allergen_translations,name,$en_id"],
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
