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
            "dial_code" => ['required', "max:4", "starts_with:+", "unique:$this->table,dial_code"],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:10000'],
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
            'name:ar' => ['required', 'string', 'max:255', "unique:country_translations,name,$ar_id"],
            'name:en' => ['required', 'string', 'max:255', "unique:country_translations,name,$en_id"],
            "dial_code" => ['required', "max:4", "starts_with:+", "unique:$this->table,dial_code,$this->country"],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:10000'],
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
