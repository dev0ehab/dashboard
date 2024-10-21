<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Exhibitions\Entities\Exhibition;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'exhibition_id',
    ];


    public function exhibition()
    {
        return $this->belongsTo(Exhibition::class);
    }

}
