<?php

namespace Modules\Branches\Entities;

use App\Traits\Filterable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Accounts\Entities\BaseModel;
use Modules\Countries\Entities\Country;

class Branch extends BaseModel
{
    use Filterable, Translatable ;

    protected $fillable = [
        'country_id',
        'address',
        'lat',
        'long',
    ];

    public $translatedAttributes = [
        'name',
    ];

    protected $with = ['translations' , 'country'] ;

    protected $casts = ['is_active' => 'boolean'];



    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

}
