<?php

namespace Modules\Settings\Http\Requests;

use Modules\Accounts\Http\Requests\BaseModelRequest;

class SettingRequest extends BaseModelRequest
{
    protected $module_name = 'settings';
    protected $table = 'settings';

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            "name:en" => ['sometimes', 'string', 'max:255'],
            "name:ar" => ['sometimes', 'string', 'max:255'],

            "description:en" => ['sometimes', 'string', 'max:255'],
            "description:ar" => ['sometimes', 'string', 'max:255'],

            "our_vision:en" => ['sometimes', 'string', 'max:255'],
            "our_vision:ar" => ['sometimes', 'string', 'max:255'],
            "our_mission:en" => ['sometimes', 'string', 'max:255'],
            "our_mission:ar" => ['sometimes', 'string', 'max:255'],
            "our_tasks:en" => ['sometimes', 'string', 'max:255'],
            "our_tasks:ar" => ['sometimes', 'string', 'max:255'],

            "trade_register" => ['sometimes', 'string', 'max:255'],

            "email" => ['sometimes', 'string', 'max:255'],
            "phone" => ['sometimes', 'numeric'],
            "mobile" => ['sometimes', 'numeric'],
            "whats_app" => ['sometimes', 'numeric'],
            "address" => ['sometimes', 'string', 'max:255'],
            "lat" => ['sometimes', 'numeric'],
            "lng" => ['sometimes', 'numeric'],

            "facebook" => ['sometimes', 'url', 'string', 'max:255'],
            "linkedin" => ['sometimes', 'url', 'string', 'max:255'],
            "twitter" => ['sometimes', 'url', 'string', 'max:255'],
            "tiktok" => ['sometimes', 'url', 'string', 'max:255'],
            "snapchat" => ['sometimes', 'url', 'string', 'max:255'],

            "policy:en" => ['sometimes', 'string'],
            "policy:ar" => ['sometimes', 'string'],
            "about:en" => ['sometimes', 'string'],
            "about:ar" => ['sometimes', 'string'],
            "terms:en" => ['sometimes', 'string'],
            "terms:ar" => ['sometimes', 'string'],

            "facebook_pixel" => ["sometimes", 'string', 'max:255'],
            "snapchat_pixel" => ["sometimes", 'string', 'max:255'],
            "tiktok_pixel" => ["sometimes", 'string', 'max:255'],
            "google_ads_pixel" => ["sometimes", 'string', 'max:255'],
            "google_analytics" => ["sometimes", 'string', 'max:255'],
            "google_tag_manager_pixel" => ["sometimes", 'string', 'max:255'],

            'logo' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000'],
            'favicon' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000'],
            'loginLogo' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000'],
            'loginBackground' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000'],
        ];
    }


    /**
     * This function is called after validation passes.
     *
     * If you need to do additional validation, override this function.
     *
     * @return void
     */
    protected function additionalValidation()
    {
        //
    }
}
