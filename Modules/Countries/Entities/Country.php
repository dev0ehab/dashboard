<?php

namespace Modules\Countries\Entities;

use App\Traits\Filterable;
use Astrotomic\Translatable\Translatable;
use Modules\Accounts\Entities\BaseModel;

class Country extends BaseModel
{
    use Filterable, Translatable ;

    protected $fillable = [
        'name',
        'is_active',
    ];

    public $translatedAttributes = [
        'name',
    ];

    protected $with = ['translations'];


}
