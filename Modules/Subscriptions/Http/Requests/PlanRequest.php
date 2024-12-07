<?php

namespace Modules\Subscriptions\Http\Requests;

use DB;
use Modules\Accounts\Http\Requests\BaseModelRequest;

class PlanRequest extends BaseModelRequest
{
    protected $module_name = 'subscriptions';
    protected $additional_module_name = 'plans';
    protected $table = 'plans';


    /**
     * @return array
     */
    protected function createRules(): array
    {
        return [
            'name:ar' => ['required', 'string', 'max:255', "unique:plan_translations,name"],
            'name:en' => ['required', 'string', 'max:255', "unique:plan_translations,name"],
            'description:ar' => ['required', 'string'],
            'description:en' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:10000'],
            'country_id' => ['required', 'exists:countries,id'],
            'plan_category_id' => ['required', 'exists:plan_categories,id'],
            'min_calories' => ['required', 'numeric', 'min:1'],
            'max_calories' => ['required', 'numeric', 'gt:min_calories'],


            'versions' => ['required', 'array'],
            'versions.*.number_of_days' => ['required', 'numeric', 'min:1', 'max:7'],
            'versions.*.meal_price_per_day' => ['required', 'decimal:2', 'min:.1'],
            'versions.*.delivery_price_per_day' => ['required', 'decimal:2', 'min:.1'],
            'versions.*.discount' => ['required', 'numeric', 'max:100'],
            'versions.*.subscription_type' => ['required', 'string', 'in:weekly,monthly,yearly'],

            'meals' => ['required', 'array'],
            'meals.*.meal_category_id' => ['required', 'exists:meal_categories,id'],
            'meals.*.quantity' => ['required', 'numeric', 'min:1'],
        ];
    }

    /**
     * @return array
     */
    protected function updateRules(): array
    {
        $plan_translations = DB::table('plan_translations')->where('plan_id', $this->plan)->get();
        $ar_id = $plan_translations->where('locale', 'ar')->first()?->id;
        $en_id = $plan_translations->where('locale', 'en')->first()?->id;

        return [
            'name:ar' => ['sometimes', 'string', 'max:255', "unique:plan_translations,name,$ar_id"],
            'name:en' => ['sometimes', 'string', 'max:255', "unique:plan_translations,name,$en_id"],
            'description:ar' => ['sometimes', 'string'],
            'description:en' => ['sometimes', 'string'],
            'image' => ['sometimes', 'image', 'mimes:jpeg,png,jpg', 'max:10000'],
            'country_id' => ['sometimes', 'exists:countries,id'],
            'plan_category_id' => ['sometimes', 'exists:plan_categories,id'],
            'min_calories' => ['sometimes', 'numeric', 'min:1'],
            'max_calories' => ['sometimes', 'numeric', 'gt:min_calories'],

            'versions' => ['sometimes', 'array'],
            'versions.*.number_of_days' => ['required', 'numeric', 'min:1', 'max:7'],
            'versions.*.meal_price_per_day' => ['required', 'decimal:2', 'min:.1'],
            'versions.*.delivery_price_per_day' => ['required', 'decimal:2', 'min:.1'],
            'versions.*.discount' => ['required', 'numeric', 'max:100'],
            'versions.*.subscription_type' => ['required', 'string', 'in:weekly,monthly,yearly'],

            'meals' => ['sometimes', 'array'],
            'meals.*.meal_category_id' => ['required', 'exists:meal_categories,id'],
            'meals.*.quantity' => ['required', 'numeric', 'min:1'],
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
