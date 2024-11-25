<?php

namespace Modules\Countries\Entities;

use App\Traits\Filterable;
use Astrotomic\Translatable\Translatable;
use Modules\Accounts\Entities\BaseModel;

class Country extends BaseModel
{
    use Filterable, Translatable ;

    protected $fillable = [
        'dial_code',
        'country_code',
        'is_active',
    ];

    public $translatedAttributes = [
        'name',
        'currency',
    ];

    protected $with = ['translations'];

    protected $casts = ['is_active' => 'boolean'];


}
