<?php

namespace Modules\Admins\Transformers;


/** @mixin \Modules\Admins\Entities\Admin */
class AdminResource extends AdminBreifResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'phone_verified_at' => $this->phone_verified_at,
            'email_verified_at' => $this->email_verified_at,
        ]);

    }
}
