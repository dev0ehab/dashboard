<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Laraeast\LaravelSettings\Facades\Settings;
use Modules\Settings\Entities\Setting;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * The list of the images keys.
     *
     * @var array
     */
    protected $images = [
        'logo',
        'favicon',
        'loginLogo',
        'loginBackground',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'phone' => '002 (010) - 02100 6315',
            'mobile' => '002 (010) - 02100 6311',
            'whats_app' => '01005062221',
            'fax' => '(+202) 23417149',
            'trade_register' => '132132165465',

            'our_vision:en' => 'our_vision',
            'our_vision:ar' => 'رؤيتنا',

            'our_mission:en' => 'our_mission',
            'our_mission:ar' => 'مهمتنا',

            'our_tasks:en' => 'our_tasks',
            'our_tasks:ar' => 'واجبنا',

            'name:ar' => 'فيجن كو',
            'name:en' => 'Vision Co',

            'description:ar' => 'فيجن كو',
            'description:en' => 'Vision Co',


            'policy:ar' => '<p> سياسة الخصوصية </p>',
            'policy:en' => '<p> policy </p>',

            'about:ar' => '<p> من نحن </p>',
            'about:en' => '<p> about us </p>',

            'terms:ar' => '<p> الشروط و الاحكام </p>',
            'terms:en' => '<p> terms </p>',

            'email' => 'info@vision.com',
            'facebook' => 'https://www.facebook.com/vision',
            'snapchat' => 'https://www.snapchat.net/vision',
            'linkedin' => 'https://www.linkedin.com/vision',
            'twitter' => 'https://www.twitter.com/vision',
            'tiktok' => 'https://www.tiktok.com/vision',

            'address' => 'EGYPT CONVENTION AND EXHIBITION CENTER',
            'lat' => '23.12',
            'lng' => '23.12',

            'facebook_pixel' => 'vision',
            'snapchat_pixel' => 'vision',
            'tiktok_pixel' => 'vision',
            'google_ads_pixel' => 'vision',
            'google_analytics' => 'vision',
            'google_tag_manager_pixel' => 'vision',

        ];


        foreach ($data as $key => $value) {
            Settings::set($key, $value);
        }


        foreach ($this->images as $image) {
            Setting::setImage($image)
                ->addMedia(__DIR__ . '/images/' . $image . '.png')
                ->preservingOriginal()
                ->toMediaCollection($image);
        }
    }
}
