<?php

namespace Modules\Menus\Entities;

use Illuminate\Database\Eloquent\Model;


class MenuTranslation extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $table = 'menu_translations';

    public $timestamps = false;
}
