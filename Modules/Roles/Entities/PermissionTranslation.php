<?php

namespace Modules\Roles\Entities;

use Illuminate\Database\Eloquent\Model;


class PermissionTranslation extends Model
{
    protected $fillable = [
        'display_name',
    ];
    protected $table = 'permission_translations';

    public $timestamps = false;
}
