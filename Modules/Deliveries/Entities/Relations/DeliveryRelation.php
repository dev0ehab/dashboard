<?php

namespace Modules\Deliveries\Entities\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Deliveries\Entities\Shift;
use Modules\Deliveries\Entities\Zone;


trait DeliveryRelation
{

    /**
     * Get the zone that owns the DeliveryRelation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }


    /**
     * Get the shift that owns the DeliveryRelation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }

}
