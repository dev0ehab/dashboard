<?php

namespace Modules\Deliveries\Http\Requests;

use DB;
use Modules\Accounts\Http\Requests\BaseModelRequest;

class ZoneRequest extends BaseModelRequest
{
    protected $module_name = 'deliveries';
    protected $additional_module_name = 'zones';
    protected $table = 'zones';


    /**
     * @return array
     */
    protected function createRules(): array
    {
        return [
            'name:ar' => ['required', 'string', 'max:255', "unique:zone_translations,name"],
            'name:en' => ['required', 'string', 'max:255', "unique:zone_translations,name"],
            'waypoints' => ['required', 'array'],
            'waypoints.*.lat' => ['required', 'numeric'],
            'waypoints.*.long' => ['required', 'numeric'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * @return array
     */
    protected function updateRules(): array
    {
        $zone_translations = DB::table('zone_translations')->where('zone_id', $this->zone)->get();
        $ar_id = $zone_translations->where('locale', 'ar')->first()?->id;
        $en_id = $zone_translations->where('locale', 'en')->first()?->id;

        return [
            'name:ar' => ['sometimes', 'string', 'max:255', "unique:zone_translations,name,$ar_id"],
            'name:en' => ['sometimes', 'string', 'max:255', "unique:zone_translations,name,$en_id"],
            'address' => ['sometimes', 'string', 'max:255'],
            'waypoints' => ['sometimes', 'array'],
            'waypoints.*.lat' => ['required', 'numeric'],
            'waypoints.*.long' => ['required', 'numeric'],
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
