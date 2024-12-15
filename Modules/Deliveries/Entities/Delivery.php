<?php

namespace Modules\Deliveries\Entities;

use Modules\Accounts\Entities\AuthModel;
use Modules\Deliveries\Entities\Helpers\DeliveryHelper;
use Modules\Deliveries\Entities\Relations\DeliveryRelation;
use Modules\Deliveries\Entities\Scopes\DeliveryScope;
use Modules\Deliveries\Transformers\DeliveryResource;

class Delivery extends AuthModel
{
    use DeliveryHelper, DeliveryRelation, DeliveryScope;

    public const AuthType = 'phone';

    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'phone',
        'dial_code',
        'preferred_locale',
        'last_login_at',
        'email_verified_at',
        'phone_verified_at',
        'device_token',
        'password',
        'zone_id',
        'shift_id',
    ];

    protected $with = [
        "zone",
        "shift",
    ];

    /**
     * Get the resource representation of the Delivery model.
     *
     * @return \Modules\Deliveries\Transformers\DeliveryResource
     */
    public function getResource()
    {
        return new DeliveryResource($this);
    }
}
