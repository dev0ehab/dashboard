<?php

namespace Modules\Subscriptions\Entities;

use Illuminate\Database\Eloquent\Model;


class PlanTranslation extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    protected $table = 'plan_translations';

    public $timestamps = false;
}
