<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Laraeast\LaravelSettings\Facades\Settings;

class SettingsDatabaseSeeder extends Seeder
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
        'cover',
        'about_image',
        'qr',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            'theme' => 'dark',
            'email' => 'info@vision.com',
            'phone' => '002 (010) - 02100 6315',
            'mobile' => '002 (010) - 02100 6311',
            'whats_app' => '01005062221',
            'fax' => '(+202) 23417149',
            'trade_register' => '132132165465',
            'name' => 'Vision Co',
            'description' => 'Vision Co',
            'policy:ar' => '<p> policy </p>',
            'policy:en' => '<p> policy </p>',
            'terms:ar' => '<p> terms </p>',
            'terms:en' => '<p> terms </p>',
            'facebook' => 'https://www.facebook.com/vision',
            'gmail' => 'https://www.gmail.com/vision',
            'snapchat' => 'https://www.snapchat.net/vision',
            'linkedin' => 'https://www.linkedin.com/vision',
            'address' => 'EGYPT CONVENTION AND EXHIBITION CENTER',
            'map_address1' => 'EGYPT CONVENTION AND EXHIBITION CENTER',
            'longitude1' => '23.12',
            'latitude1' => '23.12',
            'facebook_pixel' => "vision",
            'snapchat_pixel' => "vision",
            'tiktok_pixel' => "vision",
            'google_ads_pixel' => "vision",
            'google_analytics' => "vision",
            'google_tag_manager_pixel' => "vision",
            'clearity' => "vision",
        ];

        $titles = [
            [
                "name" => "header_title",
                "locale" => "en",
                "data" => "DIGITAL MARKETING AGENCY",
            ],
            [
                "name" => "header_title",
                "locale" => "ar",
                "data" => "وكالة التسويق الرقمي",
            ],
            [
                "name" => "header_sub_title",
                "locale" => "en",
                "data" => "Grow & Nuture The Ideas You Have.",
            ],
            [
                "name" => "header_sub_title",
                "locale" => "ar",
                "data" => "تنمية وتغذي الأفكار التي لديك.",
            ],
            [
                "name" => "header_desc",
                "locale" => "en",
                "data" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente doloremque unde impedit",
            ],
            [
                "name" => "header_desc",
                "locale" => "ar",
                "data" => "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة",
            ],
            [
                "name" => "about_header",
                "locale" => "en",
                "data" => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente eos nesciunt voluptate eos nesciunt voluptate</p>',
            ],
            [
                "name" => "about_header",
                "locale" => "ar",
                "data" => '<p>من نحن ؟؟ </p>',
            ],
            [
                "name" => "testimonial_header",
                "locale" => "en",
                "data" => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente eos nesciunt voluptate eos nesciunt voluptate</p>',
            ],
            [
                "name" => "testimonial_header",
                "locale" => "ar",
                "data" => '<p>اراء العملاء ؟؟ </p>',
            ],
            [
                "name" => "service_header",
                "locale" => "en",
                "data" => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente eos nesciunt voluptate eos nesciunt voluptate</p>',
            ],
            [
                "name" => "service_header",
                "locale" => "ar",
                "data" => '<p>الخدمات ؟؟ </p>',
            ],

            [
                "name" => "team_header",
                "locale" => "en",
                "data" => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente eos nesciunt voluptate eos nesciunt voluptate</p>',
            ],
            [
                "name" => "team_header",
                "locale" => "ar",
                "data" => '<p>الفريق ؟؟ </p>',
            ],

            [
                "name" => "client_header",
                "locale" => "en",
                "data" => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente eos nesciunt voluptate eos nesciunt voluptate</p>',
            ],
            [
                "name" => "client_header",
                "locale" => "ar",
                "data" => '<p>العملاء ؟؟ </p>',
            ],

            [
                "name" => "package_header",
                "locale" => "en",
                "data" => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente eos nesciunt voluptate eos nesciunt voluptate</p>',
            ],
            [
                "name" => "package_header",
                "locale" => "ar",
                "data" => '<p>الباقات ؟؟ </p>',
            ],

            [
                "name" => "project_header",
                "locale" => "en",
                "data" => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente eos nesciunt voluptate eos nesciunt voluptate</p>',
            ],
            [
                "name" => "project_header",
                "locale" => "ar",
                "data" => '<p>المشاريع ؟؟ </p>',
            ],

            [
                "name" => "about_desc",
                "locale" => "en",
                "data" => ' <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente eos nesciunt voluptate eos nesciunt voluptate
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente eos nesciunt voluptate eos nesciunt voluptate
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente eos nesciunt voluptate eos nesciunt voluptate
                </p>
                <br>
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente eos nesciunt voluptate eos nesciunt voluptate
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente eos nesciunt voluptate eos nesciunt voluptate
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente eos nesciunt voluptate eos nesciunt voluptate
                </p>',
            ],
            [
                "name" => "about_desc",
                "locale" => 'ar',
                "data" => '<p>
                  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
                </p>
                <br>
                <p>
                  إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.
                </p>',
            ],

        ];

        foreach ($data as $key => $value) {
            Settings::set($key, $value);
        }

        foreach ($titles as $title) {
            Settings::locale($title['locale'])->set($title['name'], $title['data']);
        }


        // images
        foreach ($this->images as $image) {
            Settings::set($image)->addMedia(__DIR__ . '/images/' . $image . '.png')
                ->preservingOriginal()
                ->toMediaCollection($image);
        }

        // pdf file
        Settings::set("site_pdf")->addMedia(__DIR__ . '/file/' . "site_pdf" . '.pdf')
            ->preservingOriginal()
            ->toMediaCollection("site_pdf");
    }
}
