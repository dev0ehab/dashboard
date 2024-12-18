<?php

namespace Modules\Admins\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Modules\Admins\Entities\Admin */
class AdminBreifResource extends JsonResource
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
            'name' => (string) $this->name,
            'f_name' => (string) $this->f_name,
            'l_name' => (string) $this->l_name,
            'email' => (string) $this->email,
            'phone' => (string) $this->phone,
            'avatar' => $this->avatar,
            // 'preferred_locale' => $this->preferred_locale,
            // 'device_token' => $this->device_token,
            'role' => (string) $this->role?->name,
            'branch' => (string) $this->branch->name,
            'created_at' => $this->created_at,
        ];
    }
}
