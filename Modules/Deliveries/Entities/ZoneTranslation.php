<?php

namespace Modules\Deliveries\Entities;

use Illuminate\Database\Eloquent\Model;


class ZoneTranslation extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $table = 'zone_translations';

    public $timestamps = false;
}
