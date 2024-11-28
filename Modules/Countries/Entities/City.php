<?php

namespace Modules\Countries\Entities;

use App\Traits\Filterable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Accounts\Entities\BaseModel;

class City extends BaseModel
{
    use Filterable, Translatable;

    protected $fillable = [
        'state_id',
        'is_active',
    ];

    public $translatedAttributes = [
        'name',
    ];

    protected $with = [
        'translations',
    ];

    protected $casts = ['is_active' => 'boolean'];


    /**
     * Get the state that owns the City
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

}
