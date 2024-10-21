<?php

namespace Modules\Settings\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Laraeast\LaravelSettings\Facades\Settings;

class SeoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $inputs = [
            'home_seo_title',
            'home_seo_keywords',
            'home_seo_description',
            'services_seo_title',
            'services_seo_keywords',
            'services_seo_description',
            'about_seo_title',
            'about_seo_keywords',
            'about_seo_description',
            'projects_seo_title',
            'projects_seo_keywords',
            'projects_seo_description',
            'terms_seo_title',
            'terms_seo_keywords',
            'terms_seo_description',
            'privacy_seo_title',
            'privacy_seo_keywords',
            'privacy_seo_description',
        ];

        foreach (config("locales.languages") as $locale) {
            $localizedData = [];
            foreach ($inputs as $input) {
                $localizedData[$input] =  Settings::locale($locale["code"])->get($input);
            }
            $seo[$locale["code"]] = $localizedData;
        }

        return [
            // ---- GOOGLE PIXEL
            'transfer_line' => Settings::get('transfer_line'),
            'btn_google_id_footer' => Settings::get('btn_google_id_footer'),
            'btn_track_code' => Settings::get('btn_track_code'),
            'google_analects' => Settings::get('google_analects'),
            'track_code' => Settings::get('track_code'),
            'google_id_footer' => Settings::get('google_id_footer'),
            'facebook_pixel' => Settings::get('facebook_pixel'),
            'snapchat_pixel' => Settings::get('snapchat_pixel'),
            'google_analects' => Settings::get('google_analects'),

            // ----- SEO

            "seo" => $seo
        ];
    }
}
