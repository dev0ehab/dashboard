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
            'name' => $this->name,
            'f_name' => $this->f_name,
            'l_name' => $this->l_name,
            'email' => (string) $this->email,
            'phone' => (string) $this->phone,
            'avatar' => $this->avatar,
            'role' => $this->role,

            'created_at' => $this->created_at->toDateTimeString(),
            'created_at_formatted' => $this->created_at->diffForHumans(),
        ];
    }
}
