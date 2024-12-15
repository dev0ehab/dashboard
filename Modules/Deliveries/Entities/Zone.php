<?php

namespace Modules\Deliveries\Entities;

use App\Casts\JsonArrayCast;
use App\Traits\Filterable;
use Astrotomic\Translatable\Translatable;
use Modules\Accounts\Entities\BaseModel;

class Zone extends BaseModel
{
    use Filterable, Translatable;

    protected $fillable = [
        'waypoints',
    ];

    public $translatedAttributes = [
        'name',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'translations',
    ];

    protected $casts = [
        'waypoints' => JsonArrayCast::class,
        'is_active' => 'boolean'
    ];
}
