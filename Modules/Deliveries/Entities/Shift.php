<?php

namespace Modules\Deliveries\Entities;

use App\Traits\Filterable;
use Astrotomic\Translatable\Translatable;
use Modules\Accounts\Entities\BaseModel;

class Shift extends BaseModel
{
    use Filterable, Translatable;

    protected $fillable = [
        'start_at',
        'end_at',
    ];

    public $translatedAttributes = [
        'name',
    ];

    protected $with = ['translations'];

    protected $casts = ['is_active' => 'boolean'];
}
