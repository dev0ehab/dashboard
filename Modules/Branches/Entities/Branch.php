<?php

namespace Modules\Branches\Entities;

use App\Traits\Filterable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Accounts\Entities\BaseModel;
use Modules\Countries\Entities\City;

class Branch extends BaseModel
{
    use Filterable, Translatable;

    protected $fillable = [
        'city_id',
        'address',
        'lat',
        'long',
    ];

    public $translatedAttributes = [
        'name',
    ];

    protected $with = ['translations', 'city'];

    protected $casts = ['is_active' => 'boolean'];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
