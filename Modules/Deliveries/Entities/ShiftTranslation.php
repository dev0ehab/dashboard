<?php

namespace Modules\Deliveries\Entities;

use Illuminate\Database\Eloquent\Model;


class ShiftTranslation extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $table = 'shift_translations';

    public $timestamps = false;
}
