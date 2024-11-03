<?php

namespace Modules\Roles\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Modules\Roles\Entities\Role */
class PermissionBreifResource extends JsonResource
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
            'display_name' => translations($this, 'display_name'),
            'name' => $this->name,
        ];
    }
}
