<?php

namespace Modules\Countries\Entities;

use Illuminate\Database\Eloquent\Model;


class CityTranslation extends Model
{
    protected $fillable = [
        'name',
    ];
    protected $table = 'city_translations';

    public $timestamps = false;
}
