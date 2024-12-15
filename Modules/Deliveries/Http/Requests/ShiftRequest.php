<?php

namespace Modules\Deliveries\Http\Requests;

use DB;
use Modules\Accounts\Http\Requests\BaseModelRequest;

class ShiftRequest extends BaseModelRequest
{
    protected $module_name = 'deliveries';
    protected $additional_module_name = 'shifts';
    protected $table = 'shifts';


    /**
     * @return array
     */
    protected function createRules(): array
    {
        return [
            'name:ar' => ['required', 'string', 'max:255', "unique:shift_translations,name"],
            'name:en' => ['required', 'string', 'max:255', "unique:shift_translations,name"],
            'start_at' => ['required', 'date_format:H:i'],
            'end_at' => ['required', 'date_format:H:i', 'after:start_at'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * @return array
     */
    protected function updateRules(): array
    {
        $shift_translations = DB::table('shift_translations')->where('shift_id', $this->shift)->get();
        $ar_id = $shift_translations->where('locale', 'ar')->first()?->id;
        $en_id = $shift_translations->where('locale', 'en')->first()?->id;

        return [
            'name:ar' => ['sometimes', 'string', 'max:255', "unique:shift_translations,name,$ar_id"],
            'name:en' => ['sometimes', 'string', 'max:255', "unique:shift_translations,name,$en_id"],
            'start_at' => ['sometimes', 'date_format:H:i'],
            'end_at' => ['sometimes', 'date_format:H:i', 'after:start_at'],
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
