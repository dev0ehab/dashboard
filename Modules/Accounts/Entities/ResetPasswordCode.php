<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ResetPasswordCode extends Model
{
    /**
     * the code expiration by seconds.
     *
     * @var int
     */
    const EXPIRE_DURATION = 10 * 60;

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'resetable_id',
        'resetable_type',
        "reset_type",
        "reset_value",
        'code',
        'created_at',
    ];

    /**
     * Determine whither this code has been expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->created_at->addSeconds(static::EXPIRE_DURATION)->isPast();
    }


    /**
     * Get the resetable model .
     */
    public function resetable(): MorphTo
    {
        return $this->morphTo();
    }
}
