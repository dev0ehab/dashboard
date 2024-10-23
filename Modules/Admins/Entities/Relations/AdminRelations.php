<?php


namespace Modules\Admins\Entities\Relations;

use App\Models\Verification;
use Illuminate\Database\Eloquent\Relations\MorphOne;


trait AdminRelations
{
    /**
     * Get verification model .
     */
    public function verification(): MorphOne
    {
        return $this->morphOne(Verification::class, 'verifiable');
    }


}
