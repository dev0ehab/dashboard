<?php


namespace Modules\Admins\Entities\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Branches\Entities\Branch;

trait AdminRelation
{

    /**
     * The permittedBranches that belong to the AdminRelation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permittedBranches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'admin_branches');
    }

    /**
     * Get the mainBranch that owns the AdminRelation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

}
