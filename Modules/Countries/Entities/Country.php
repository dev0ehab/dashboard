<?php

namespace Modules\Countries\Entities;

use App\Traits\Filterable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Accounts\Entities\BaseModel;

class Country extends BaseModel
{
    use Filterable, Translatable;

    protected $fillable = [
        'dial_code',
        'country_code',
        'is_active',
    ];

    public $translatedAttributes = [
        'name',
        'currency',
    ];

    protected $with = [
        'translations',
        'media',
    ];

    protected $casts = ['is_active' => 'boolean'];


    /**
     * Get all of the states for the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
