<?php

namespace Modules\Countries\Http\Requests;

use DB;
use Modules\Accounts\Http\Requests\BaseModelRequest;

class CountryRequest extends BaseModelRequest
{
    protected $module_name = 'countries';
    protected $additional_module_name = 'countries';
    protected $table = 'countries';


    /**
     * @return array
     */
    protected function createRules(): array
    {
        return [
            'name:ar' => ['required', 'string', 'max:255', "unique:country_translations,name"],
            'name:en' => ['required', 'string', 'max:255', "unique:country_translations,name"],
            'currency:ar' => ['required', 'string', 'max:255'],
            'currency:en' => ['required', 'string', 'max:255'],
            "dial_code" => ['required', "max:4", "starts_with:+", "unique:$this->table,dial_code"],
            "country_code" => ['required', "string", "unique:$this->table,country_code"],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:10000'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * @return array
     */
    protected function updateRules(): array
    {
        $country_translations = DB::table('country_translations')->where('country_id', $this->country)->get();
        $ar_id = $country_translations->where('locale', 'ar')->first()?->id;
        $en_id = $country_translations->where('locale', 'en')->first()?->id;

        return [
            'name:ar' => ['sometimes', 'string', 'max:255', "unique:country_translations,name,$ar_id"],
            'name:en' => ['sometimes', 'string', 'max:255', "unique:country_translations,name,$en_id"],
            '%currency%' => ['sometimes', 'string', 'max:255'],
            "dial_code" => ['sometimes', "max:4", "starts_with:+", "unique:$this->table,dial_code,$this->country"],
            "country_code" => ['sometimes', "string", "unique:$this->table,country_code,$this->country"],
            'image' => ['sometimes', 'image', 'mimes:jpeg,png,jpg', 'max:10000'],
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
