<?php

namespace Modules\Countries\Entities;

use Illuminate\Database\Eloquent\Model;


class CountryTranslation extends Model
{
    protected $fillable = [
        'name',
        'currency',
    ];
    protected $table = 'country_translations';

    public $timestamps = false;
}
