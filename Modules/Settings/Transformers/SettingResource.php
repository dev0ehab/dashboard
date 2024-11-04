<?php

namespace Modules\Settings\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Laraeast\LaravelSettings\Facades\Settings;
use Modules\Settings\Entities\Setting;

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
            'name' => translations(Settings::class, 'name'),
            'description' => translations(Settings::class, 'description'),
            'our_vision' => translations(Settings::class, 'our_vision'),
            'our_mission' => translations(Settings::class, 'our_mission'),
            'our_tasks' => translations(Settings::class, 'our_tasks'),
            'trade_register' => Settings::get('trade_register'),

            'email' => Settings::get('email'),
            'phone' => Settings::get('phone'),
            'mobile' => Settings::get('mobile'),
            'whats_app' => Settings::get('whats_app'),

            "location" => [
                "address" => Settings::get('address'),
                "lat" => Settings::get('lat'),
                "lng" => Settings::get('lng'),
            ],

            'social' => [
                'facebook' => Settings::get('facebook'),
                'linkedin' => Settings::get('linkedin'),
                'twitter' => Settings::get('twitter'),
                'tiktok' => Settings::get('tiktok'),
                'snapchat' => Settings::get('snapchat'),
            ],

            'static_pages' => [
                'policy' => translations(Settings::class, 'policy'),
                'about' => translations(Settings::class, 'about'),
                'terms' => translations(Settings::class, 'terms'),
            ],

            'seo' => [
                'facebook_pixel' => Settings::get('facebook_pixel'),
                'snapchat_pixel' => Settings::get('snapchat_pixel'),
                'tiktok_pixel' => Settings::get('tiktok_pixel'),
                'google_ads_pixel' => Settings::get('google_ads_pixel'),
                'google_analytics' => Settings::get('google_analytics'),
                'google_tag_manager_pixel' => Settings::get('google_tag_manager_pixel'),
            ],

            "logo" => Setting::find(Settings::instance('logo')->id)->getFirstMediaUrl('logo'),
            "favicon" => Setting::find(Settings::instance('favicon')->id)->getFirstMediaUrl('favicon'),
            "loginLogo" => Setting::find(Settings::instance('loginLogo')->id)->getFirstMediaUrl('loginLogo'),
            "loginBackground" => Setting::find(Settings::instance('loginBackground')->id)->getFirstMediaUrl('loginBackground'),
        ];
    }
}
