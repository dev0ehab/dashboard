<?php

namespace Modules\Menus\Http\Requests;

use DB;
use Modules\Accounts\Http\Requests\BaseModelRequest;

class MealCategoryRequest extends BaseModelRequest
{
    protected $module_name = 'menus';
    protected $additional_module_name = 'meal_categories';
    protected $table = 'meal_categories';


    /**
     * @return array
     */
    protected function createRules(): array
    {
        return [
            'name:ar' => ['required', 'string', 'max:255', "unique:meal_category_translations,name"],
            'name:en' => ['required', 'string', 'max:255', "unique:meal_category_translations,name"],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * @return array
     */
    protected function updateRules(): array
    {
        $meal_category_translations = DB::table('meal_category_translations')->where('meal_category_id', $this->meal_category)->get();
        $ar_id = $meal_category_translations->where('locale', 'ar')->first()?->id;
        $en_id = $meal_category_translations->where('locale', 'en')->first()?->id;

        return [
            'name:ar' => ['sometimes', 'string', 'max:255', "unique:meal_category_translations,name,$ar_id"],
            'name:en' => ['sometimes', 'string', 'max:255', "unique:meal_category_translations,name,$en_id"],
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
