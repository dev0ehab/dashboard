@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="accordion" id="accordionExample">

    <div class="card">
        <div class="card-header" id="heading2">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                    # {{ __('Menu Items') }}
                </button>
            </h2>
        </div>

        <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('menu_home_en')->value(Settings::get('menu_home_en'))->label(__('Home (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('menu_home_ar')->value(Settings::get('menu_home_ar'))->label(__('Home (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('menu_about_en')->value(Settings::get('menu_about_en'))->label(__('About (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('menu_about_ar')->value(Settings::get('menu_about_ar'))->label(__('About (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('menu_services_en')->value(Settings::get('menu_services_en'))->label(__('Services (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('menu_services_ar')->value(Settings::get('menu_services_ar'))->label(__('Services (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('menu_gallery_en')->value(Settings::get('menu_gallery_en'))->label(__('Gallery (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('menu_gallery_ar')->value(Settings::get('menu_gallery_ar'))->label(__('Gallery (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('menu_reports_en')->value(Settings::get('menu_reports_en'))->label(__('Reports (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('menu_reports_ar')->value(Settings::get('menu_reports_ar'))->label(__('Reports (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('menu_volunteers_en')->value(Settings::get('menu_volunteers_en'))->label(__('Volunteers (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('menu_volunteers_ar')->value(Settings::get('menu_volunteers_ar'))->label(__('Volunteers (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('menu_donation_en')->value(Settings::get('menu_donation_en'))->label(__('Donation (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('menu_donation_ar')->value(Settings::get('menu_donation_ar'))->label(__('Donation (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('menu_contact_en')->value(Settings::get('menu_contact_en'))->label(__('Contact Us (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('menu_contact_ar')->value(Settings::get('menu_contact_ar'))->label(__('Contact Us (ar)')) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="heading3">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                    # {{ __('Footer Items') }}
                </button>
            </h2>
        </div>

        <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionExample">
            <div class="card-body">

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('footer_contactinfo_en')->value(Settings::get('footer_contactinfo_en'))->label(__('Contact Information (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('footer_contactinfo_ar')->value(Settings::get('footer_contactinfo_ar'))->label(__('Contact Information (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('footer_addresses_en')->value(Settings::get('footer_addresses_en'))->label(__('Addresses (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('footer_addresses_ar')->value(Settings::get('footer_addresses_ar'))->label(__('Addresses (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('footer_email_en')->value(Settings::get('footer_email_en'))->label(__('Email (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('footer_email_ar')->value(Settings::get('footer_email_ar'))->label(__('Email (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('footer_phone_en')->value(Settings::get('footer_phone_en'))->label(__('Phone (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('footer_phone_ar')->value(Settings::get('footer_phone_ar'))->label(__('Phone (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('footer_copyright_en')->value(Settings::get('footer_copyright_en'))->label(__('Copyright (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('footer_copyright_ar')->value(Settings::get('footer_copyright_ar'))->label(__('Copyright (ar)')) }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="heading4">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                    # {{__("Home Page")}}
                </button>
            </h2>
        </div>

        <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('welcome_text_en')->value(Settings::get('welcome_text_en'))->label(__('Welcome Text (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('welcome_text_ar')->value(Settings::get('welcome_text_ar'))->label(__('Welcome Text (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('services_sec_title_en')->value(Settings::get('services_sec_title_en'))->label(__('Services Section Title (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('services_sec_title_ar')->value(Settings::get('services_sec_title_ar'))->label(__('Services Section Title (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('services_sec_description_en')->value(Settings::get('services_sec_description_en'))->rows(3)->label(__('Services Section Decription (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('services_sec_description_ar')->value(Settings::get('services_sec_description_ar'))->rows(3)->label(__('Services Section Decription (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('prod_sec_title_en')->value(Settings::get('prod_sec_title_en'))->label(__('Product Section Title (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('prod_sec_title_ar')->value(Settings::get('prod_sec_title_ar'))->label(__('Product Section Title (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('prod_sec_text_en')->value(Settings::get('prod_sec_text_en'))->rows(3)->label(__('Product Section Text (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('prod_sec_text_ar')->value(Settings::get('prod_sec_text_ar'))->rows(3)->label(__('Product Section Text (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('partners_sec_title_en')->value(Settings::get('partners_sec_title_en'))->label(__('Partners Section Title (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('partners_sec_title_ar')->value(Settings::get('partners_sec_title_ar'))->label(__('Partners Section Title (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('partners_sec_description_en')->value(Settings::get('partners_sec_description_en'))->rows(3)->label(__('Partners Section Description (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('partners_sec_description_ar')->value(Settings::get('partners_sec_description_ar'))->rows(3)->label(__('Partners Section Description (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('volunteers_sec_title_en')->value(Settings::get('volunteers_sec_title_en'))->label(__('Volunteers Section Title (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('volunteers_sec_title_ar')->value(Settings::get('volunteers_sec_title_ar'))->label(__('Volunteers Section Title (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('volunteers_sec_text_en')->value(Settings::get('volunteers_sec_text_en'))->rows(3)->label(__('Volunteers Section Text (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('volunteers_sec_text_ar')->value(Settings::get('volunteers_sec_text_ar'))->rows(3)->label(__('Volunteers Section Text (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('about_sec_title_en')->value(Settings::get('about_sec_title_en'))->label(__('About Section Title (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('about_sec_title_ar')->value(Settings::get('about_sec_title_ar'))->label(__('About Section Title (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('about_sec_description_en')->value(Settings::get('about_sec_description_en'))->rows(3)->label(__('About Section Description (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('about_sec_description_ar')->value(Settings::get('about_sec_description_ar'))->rows(3)->label(__('About Section Description (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('about_sec_subtitle_en')->value(Settings::get('about_sec_subtitle_en'))->label(__('About Section Sub Title (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('about_sec_subtitle_ar')->value(Settings::get('about_sec_subtitle_ar'))->label(__('About Section Sub Title (ar)')) }}
                    </div>
                </div>


                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('news_sec_title_en')->value(Settings::get('news_sec_title_en'))->label(__('News Section Title (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('news_sec_title_ar')->value(Settings::get('news_sec_title_ar'))->label(__('News Section Title (ar)')) }}
                    </div>
                </div>


                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('subscribe_form_title_en')->value(Settings::get('subscribe_form_title_en'))->label(__('Subscribe From Title (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('subscribe_form_title_ar')->value(Settings::get('subscribe_form_title_ar'))->label(__('Subscribe From Title (ar)')) }}
                    </div>
                </div>


                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('subscribe_sec_title_en')->value(Settings::get('subscribe_sec_title_en'))->label(__('Subscribe Section Title (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('subscribe_sec_title_ar')->value(Settings::get('subscribe_sec_title_ar'))->label(__('Subscribe Section Title (ar)')) }}
                    </div>
                </div>


                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('subscribe_sec_description_en')->value(Settings::get('subscribe_sec_description_en'))->rows(3)->label(__('Subscribe Section Description (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('subscribe_sec_description_ar')->value(Settings::get('subscribe_sec_description_ar'))->rows(3)->label(__('Subscribe Section Description (ar)')) }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="heading7">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                    # {{__("About Page")}}
                </button>
            </h2>
        </div>

        <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('awards_title_en')->value(Settings::get('awards_title_en'))->label(__('Awards Section Title (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('awards_title_ar')->value(Settings::get('awards_title_ar'))->label(__('Awards Section Title (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('awards_desc_en')->value(Settings::get('awards_desc_en'))->rows(3)->label(__('Awards Section Description (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('awards_desc_ar')->value(Settings::get('awards_desc_ar'))->rows(3)->label(__('Awards Section Description (ar)')) }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="heading8">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
                    # {{__("Services Page")}}
                </button>
            </h2>
        </div>

        <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('service_page_title_en')->value(Settings::get('service_page_title_en'))->label(__('Services Page Title (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('service_page_title_ar')->value(Settings::get('service_page_title_ar'))->label(__('Services Page Title (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('service_page_desc_en')->value(Settings::get('service_page_desc_en'))->rows(3)->label(__('Services Page Description (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('service_page_desc_ar')->value(Settings::get('service_page_desc_ar'))->rows(3)->label(__('Services Page Description (ar)')) }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="heading9">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
                    # {{__("Reports Page")}}
                </button>
            </h2>
        </div>

        <div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('report_page_title_en')->value(Settings::get('report_page_title_en'))->label(__('Reports Page Title (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('report_page_title_ar')->value(Settings::get('report_page_title_ar'))->label(__('Reports Page Title (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('report_page_desc_en')->value(Settings::get('report_page_desc_en'))->rows(3)->label(__('Reports Page Description (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('report_page_desc_ar')->value(Settings::get('report_page_desc_ar'))->rows(3)->label(__('Reports Page Description (ar)')) }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- <div class="card">
        <div class="card-header" id="heading6">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                    # {{__("Volunteers Page")}}
                </button>
            </h2>
        </div>

        <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('volun_title_en')->value(Settings::get('volun_title_en'))->label(__('Volunteers Page Title (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('volun_title_ar')->value(Settings::get('volun_title_ar'))->label(__('Volunteers Page Title (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('volun_form_title_en')->value(Settings::get('volun_form_title_en'))->label(__('Volunteers Page Form Title (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('volun_form_title_ar')->value(Settings::get('volun_form_title_ar'))->label(__('Volunteers Page Form Title (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q1_en')->value(Settings::get('volun_q1_en'))->rows(3)->label(__('Volunteer Question 1 (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q1_ar')->value(Settings::get('volun_q1_ar'))->rows(3)->label(__('Volunteer Question 1 (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q2_en')->value(Settings::get('volun_q2_en'))->rows(3)->label(__('Volunteer Question 2 (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q2_ar')->value(Settings::get('volun_q2_ar'))->rows(3)->label(__('Volunteer Question 2 (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q3_en')->value(Settings::get('volun_q3_en'))->rows(3)->label(__('Volunteer Question 3 (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q3_ar')->value(Settings::get('volun_q3_ar'))->rows(3)->label(__('Volunteer Question 3 (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q4_en')->value(Settings::get('volun_q4_en'))->rows(3)->label(__('Volunteer Question 4 (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q4_ar')->value(Settings::get('volun_q4_ar'))->rows(3)->label(__('Volunteer Question 4 (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q5_en')->value(Settings::get('volun_q5_en'))->rows(3)->label(__('Volunteer Question 5 (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q5_ar')->value(Settings::get('volun_q5_ar'))->rows(3)->label(__('Volunteer Question 5 (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q6_en')->value(Settings::get('volun_q6_en'))->rows(3)->label(__('Volunteer Question 6 (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q6_ar')->value(Settings::get('volun_q6_ar'))->rows(3)->label(__('Volunteer Question 6 (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q7_en')->value(Settings::get('volun_q7_en'))->rows(3)->label(__('Volunteer Question 7 (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q7_ar')->value(Settings::get('volun_q7_ar'))->rows(3)->label(__('Volunteer Question 7 (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q8_en')->value(Settings::get('volun_q8_en'))->rows(3)->label(__('Volunteer Question 8 (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('volun_q8_ar')->value(Settings::get('volun_q8_ar'))->rows(3)->label(__('Volunteer Question 8 (ar)')) }}
                    </div>
                </div>

            </div>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-header" id="heading5">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                    # {{__("Donation Page")}}
                </button>
            </h2>
        </div>

        <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionExample">
            <div class="card-body">

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('donation_page_description_en')->rows(3)->value(Settings::get('donation_page_description_en'))->label(__('Donation Page Description (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('donation_page_description_ar')->rows(3)->value(Settings::get('donation_page_description_ar'))->label(__('Donation Page Description (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::textarea('donation_method_description_en')->rows(3)->value(Settings::get('donation_method_description_en'))->label(__('Donation Methods Description (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::textarea('donation_method_description_ar')->rows(3)->value(Settings::get('donation_method_description_ar'))->label(__('Donation Methods Description (ar)')) }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="heading5">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                    # {{__("Contact Page")}}
                </button>
            </h2>
        </div>

        <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('contact_title_en')->value(Settings::get('contact_title_en'))->label(__('Contact Us Text (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('contact_title_ar')->value(Settings::get('contact_title_ar'))->label(__('Contact Us Text (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('contact_description_en')->value(Settings::get('contact_description_en'))->label(__('Contact Us Description (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('contact_description_ar')->value(Settings::get('contact_description_ar'))->label(__('Contact Us Description (ar)')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {{ BsForm::text('contact_form_title_en')->value(Settings::get('contact_form_title_en'))->label(__('Contact Us From Title (en)')) }}
                    </div>
                    <div class="col-6">
                        {{ BsForm::text('contact_form_title_ar')->value(Settings::get('contact_form_title_ar'))->label(__('Contact Us From Title (ar)')) }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- last 10 --}}

</div>
