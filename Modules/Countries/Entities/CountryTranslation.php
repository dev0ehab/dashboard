<?php

namespace Modules\Countries\Entities;

use Illuminate\Database\Eloquent\Model;


class CountryTranslation extends Model
{
    protected $fillable = [
        'display_name',
    ];
    protected $table = 'country_translations';

    public $timestamps = false;
}
