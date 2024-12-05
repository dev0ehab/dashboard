<?php

namespace Modules\Settings\Entities;


use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Accounts\Entities\BaseModel;

class Contactus extends BaseModel
{
    protected $table = 'contact_us';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
    ];

    protected $with = ['senderable'];


    /**
     * Get the senderable model .
     */
    public function senderable(): MorphTo
    {
        return $this->morphTo();
    }
}
