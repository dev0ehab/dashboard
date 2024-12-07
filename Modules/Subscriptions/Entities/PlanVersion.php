<?php

namespace Modules\Subscriptions\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Accounts\Entities\BaseModel;

class PlanVersion extends BaseModel
{
    protected $fillable = [
        'plan_id',
        'number_of_days',
        'meal_price_per_day',
        'delivery_price_per_day',
        'discount',
        'price',
        'subscription_type',

    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

}
