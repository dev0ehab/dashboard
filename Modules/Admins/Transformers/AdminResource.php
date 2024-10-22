<?php

namespace Modules\Admins\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Modules\Admins\Entities\Admin */
class AdminResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => $this->present()->type,
            'avatar' => $this->getAvatar(),
            'localed_type' => $this->present()->type,
            'created_at' => $this->created_at->toDateTimeString(),
            'created_at_formatted' => $this->created_at->diffForHumans(),
        ];
    }
}
