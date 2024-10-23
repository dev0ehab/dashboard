<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ResetPasswordToken extends Model
{
    /**
     * the code expiration by seconds.
     *
     * @var int
     */
    const EXPIRE_DURATION = 50 * 60;

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
        'token',
        'created_at',
    ];

    /**
     * const.
     */
    const UPDATED_AT = null;

    /**
     * Check if this code has been expired.
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
