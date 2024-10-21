<?php

namespace Modules\Settings\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Laraeast\LaravelSettings\Facades\Settings;

class SettingResource extends JsonResource
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
            'name' => Settings::get('name'),
            'description' => Settings::get('description'),
            'email' => Settings::get('email'),
            'phone' => Settings::get('phone'),
            'mobile' => Settings::get('mobile'),
            'whats_app' => Settings::get('whats_app'),
            'trade_register' => Settings::get('trade_register'),

            "location" => [
                "address" => Settings::get('map_address1'),
                "lat" => Settings::get('longitude1'),
                "lng" => Settings::get('latitude1'),
            ],

            'facebook' => Settings::get('facebook'),
            'linkedin' => Settings::get('linkedin'),
            'twitter' => Settings::get('twitter'),
            'tiktok' => Settings::get('tiktok'),
            'snapchat' => Settings::get('snapchat'),
            "qr" => optional(Settings::instance('qr'))->getFirstMediaUrl('qr') ,
            "site_pdf" => optional(Settings::instance('site_pdf'))->getFirstMediaUrl('site_pdf') ,
        ];
    }
}
