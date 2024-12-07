<?php

namespace Modules\Subscriptions\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Accounts\Entities\BaseModel;
use Modules\Menus\Entities\MealCategory;

class PlanMeal extends BaseModel
{
    protected $fillable = [
        'plan_id',
        'meal_category_id',
        'quantity',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function mealCategory(): BelongsTo
    {
        return $this->belongsTo(MealCategory::class);
    }
}
