<?php

namespace Modules\Subscriptions\Entities;

use App\Traits\Filterable;
use Astrotomic\Translatable\Translatable;
use Modules\Accounts\Entities\BaseModel;

class PlanCategory extends BaseModel
{
    use Filterable, Translatable;

    protected $fillable = [
        'is_active'
    ];

    public $translatedAttributes = [
        'name', 'description'
    ];

    protected $with = ['translations'];

    protected $casts = ['is_active' => 'boolean'];


    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
