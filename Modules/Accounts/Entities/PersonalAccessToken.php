<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PersonalAccessToken extends Model
{
    protected $table = 'personal_access_tokens';

    /**
     * Get the verifiable model .
     */
    public function tokenable(): MorphTo
    {
        return $this->morphTo();
    }
}
