<?php

namespace Modules\Subscriptions\Http\Requests;

use DB;
use Modules\Accounts\Http\Requests\BaseModelRequest;

class PlanCategoryRequest extends BaseModelRequest
{
    protected $module_name = 'subscriptions';
    protected $additional_module_name = 'plan_categories';
    protected $table = 'plan_categories';


    /**
     * @return array
     */
    protected function createRules(): array
    {
        return [
            'name:ar' => ['required', 'string', 'max:255', "unique:plan_category_translations,name"],
            'name:en' => ['required', 'string', 'max:255', "unique:plan_category_translations,name"],
            'description:ar' => ['required', 'string'],
            'description:en' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:10000'],
        ];
    }

    /**
     * @return array
     */
    protected function updateRules(): array
    {
        $plan_category_translations = DB::table('plan_category_translations')->where('plan_category_id', $this->plan_category)->get();
        $ar_id = $plan_category_translations->where('locale', 'ar')->first()?->id;
        $en_id = $plan_category_translations->where('locale', 'en')->first()?->id;

        return [
            'name:ar' => ['sometimes', 'string', 'max:255', "unique:plan_category_translations,name,$ar_id"],
            'name:en' => ['sometimes', 'string', 'max:255', "unique:plan_category_translations,name,$en_id"],
            'description:ar' => ['sometimes', 'string'],
            'description:en' => ['sometimes', 'string'],
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
