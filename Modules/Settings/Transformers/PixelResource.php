<?php

namespace Modules\Settings\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Laraeast\LaravelSettings\Facades\Settings;

class PixelResource extends JsonResource
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
            'facebook_pixel' => Settings::get('facebook_pixel'),
            'snapchat_pixel' => Settings::get('snapchat_pixel'),
            'tiktok_pixel' => Settings::get('tiktok_pixel'),
            'google_ads_pixel' => Settings::get('google_ads_pixel'),
            'google_analytics' => Settings::get('google_analytics'),
            'google_tag_manager_pixel' => Settings::get('google_tag_manager_pixel'),
            'clearity' => Settings::get('clearity'),
        ];
    }
}
