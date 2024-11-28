<?php

namespace Modules\Countries\Entities;

use Illuminate\Database\Eloquent\Model;


class StateTranslation extends Model
{
    protected $fillable = [
        'name',
        'currency',
    ];
    protected $table = 'state_translations';

    public $timestamps = false;
}
