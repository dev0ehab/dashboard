<?php

namespace Modules\Settings\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Settings\Entities\Setting;

class ContactSettingResource extends JsonResource
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
            'email' => Setting::get('email'),
            'phone' => Setting::get('phone'),
            'WhatsApp_number' => Setting::get('whats_app'),
        ];
    }
}
