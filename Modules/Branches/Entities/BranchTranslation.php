<?php

namespace Modules\Branches\Entities;

use Illuminate\Database\Eloquent\Model;


class BranchTranslation extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $table = 'branch_translations';

    public $timestamps = false;
}
