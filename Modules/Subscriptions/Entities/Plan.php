<?php

namespace Modules\Subscriptions\Entities;

use App\Traits\Filterable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Accounts\Entities\BaseModel;

class Plan extends BaseModel
{
    use Filterable, Translatable;

    protected $fillable = [
        'country_id',
        'plan_category_id',
        'min_calories',
        'max_calories',
        'is_active'
    ];

    public $translatedAttributes = [
        'name',
        'description'
    ];

    protected $with = [
        'translations'
    ];


    public function meals(): HasMany
    {
        return $this->hasMany(PlanMeal::class);
    }

    public function versions(): HasMany
    {
        return $this->hasMany(PlanVersion::class);
    }

}
