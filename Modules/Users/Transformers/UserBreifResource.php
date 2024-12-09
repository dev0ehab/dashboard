<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Modules\Users\Entities\User */
class UserBreifResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'f_name' => $this->f_name,
            'l_name' => $this->l_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'dial_code' => $this->dial_code,
            'avatar' => $this->avatar,
            "phone_verified_at" => $this->phone_verified_at,
            "email_verified_at" => $this->email_verified_at,
        ];
    }
}
