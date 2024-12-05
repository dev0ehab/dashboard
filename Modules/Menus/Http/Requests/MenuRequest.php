<?php

namespace Modules\Menus\Http\Requests;

use DB;
use Modules\Accounts\Http\Requests\BaseModelRequest;

class MenuRequest extends BaseModelRequest
{
    protected $module_name = 'menus';
    protected $additional_module_name = 'menus';
    protected $table = 'menus';


    /**
     * @return array
     */
    protected function createRules(): array
    {
        return [
            'name:ar' => ['required', 'string', 'max:255', "unique:menu_translations,name"],
            'name:en' => ['required', 'string', 'max:255', "unique:menu_translations,name"],
            'city_id' => ['required', 'exists:countries,id'],
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
        $menu_translations = DB::table('menu_translations')->where('menu_id', $this->menu)->get();
        $ar_id = $menu_translations->where('locale', 'ar')->first()?->id;
        $en_id = $menu_translations->where('locale', 'en')->first()?->id;

        return [
            'name:ar' => ['sometimes', 'string', 'max:255', "unique:menu_translations,name,$ar_id"],
            'name:en' => ['sometimes', 'string', 'max:255', "unique:menu_translations,name,$en_id"],
            'address' => ['sometimes', 'string', 'max:255'],
            'lat' => ['sometimes', 'numeric', 'string', 'max:255'],
            'long' => ['sometimes', 'numeric', 'string', 'max:255'],
            'city_id' => ['sometimes', 'exists:countries,id' ],
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