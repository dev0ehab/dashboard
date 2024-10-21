<?php


namespace Modules\Admins\Entities\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Task\Entities\Task;
use Modules\UserType\Entities\UserType;

trait UserRelations
{
    /**
     * @return BelongsTo
     */
    public function user_type(): BelongsTo
    {
        return $this->belongsTo(UserType::class);
    }

    /**
     * @return HasMany
     */
    public function task(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
