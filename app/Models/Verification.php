<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Verification extends Model
{
    use HasFactory;

    /**
     * the code expiration by seconds.
     *
     * @var int
     */
    const EXPIRE_DURATION = 10 * 60;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'verifiable_id',
        'verifiable_type',
        "verificiation_type",
        "verificiation_value",
        'code',
        'created_at',
    ];

    /**
     * Determine whither the verification code is expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->updated_at->addMinutes(5)->isPast();
    }

        /**
     * Get the verifiable model .
     */
    public function verifiable(): MorphTo
    {
        return $this->morphTo();
    }
}
