<?php

namespace Modules\Menus\Entities;

use App\Traits\Filterable;
use Astrotomic\Translatable\Translatable;
use Modules\Accounts\Entities\BaseModel;

class MealCategory extends BaseModel
{
    use Filterable, Translatable;

    protected $fillable = [
        'is_active'
    ];

    public $translatedAttributes = [
        'name',
    ];

    protected $with = ['translations'];

    protected $casts = ['is_active' => 'boolean'];

}
