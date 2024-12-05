<?php

namespace Modules\Settings\Transformers;


/** @mixin \Modules\Settings\Entities\Contactus */
class ContactusResource extends ContactusBreifResource
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
        ]);

    }
}
