<?php

namespace Modules\Roles\Entities;

use Illuminate\Database\Eloquent\Model;


class RoleTranslation extends Model
{
    protected $fillable = [
        'display_name',
    ];
    protected $table = 'role_translations';

    public $timestamps = false;
}
