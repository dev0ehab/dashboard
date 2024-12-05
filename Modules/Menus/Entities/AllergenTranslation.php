<?php

namespace Modules\Menus\Entities;

use Illuminate\Database\Eloquent\Model;


class AllergenTranslation extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $table = 'allergen_translations';

    public $timestamps = false;
}
