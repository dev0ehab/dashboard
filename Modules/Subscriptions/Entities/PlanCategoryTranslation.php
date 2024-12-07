<?php

namespace Modules\Subscriptions\Entities;

use Illuminate\Database\Eloquent\Model;


class PlanCategoryTranslation extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    protected $table = 'plan_category_translations';

    public $timestamps = false;
}
