<?php

namespace Modules\Countries\Entities;

use App\Traits\Filterable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Accounts\Entities\BaseModel;

class State extends BaseModel
{
    use Filterable, Translatable;

    protected $fillable = [
        'country_id',
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
     * Get all of the ciites for the State
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    /**
     * Get the country that owns the State
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
