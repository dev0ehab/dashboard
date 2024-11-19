<?php

namespace Modules\Roles\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Modules\Roles\Entities\Role */
class RoleBreifResource extends JsonResource
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
            'name' => translations($this, 'display_name'),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
