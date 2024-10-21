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
                    # {{ __('Home Page') }}
                </button>
            </h2>
        </div>

        <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample">
            <div class="card-body">
                @bsMultilangualFormTabs
                    <div class="row">
                        <div class="col-6">
                            {{ BsForm::text('home_seo_title')->value(Settings::locale($locale->code)->get('home_seo_title'))->label(__('Home SEO Title')) }}
                        </div>
                        <div class="col-6">
                            {{ BsForm::text('home_seo_keywords')->value(Settings::locale($locale->code)->get('home_seo_keywords'))->label(__('Home SEO Keywords')) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            {{ BsForm::textarea('home_seo_description')->value(Settings::locale($locale->code)->get('home_seo_description'))->rows(3)->label(__('Home SEO Description')) }}
                        </div>
                    </div>
                @endBsMultilangualFormTabs

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="heading3">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                    # {{ __('Services Page') }}
                </button>
            </h2>
        </div>

        <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionExample">
            <div class="card-body">

                @bsMultilangualFormTabs
                    <div class="row">
                        <div class="col-6">
                            {{ BsForm::text('services_seo_title')->value(Settings::locale($locale->code)->get('services_seo_title'))->label(__('Services SEO Title')) }}
                        </div>
                        <div class="col-6">
                            {{ BsForm::text('services_seo_keywords')->value(Settings::locale($locale->code)->get('services_seo_keywords'))->label(__('Services SEO Keywords')) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            {{ BsForm::textarea('services_seo_description')->value(Settings::locale($locale->code)->get('services_seo_description'))->rows(3)->label(__('Services SEO Description')) }}
                        </div>
                    </div>
                @endBsMultilangualFormTabs

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="heading5">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                    # {{ __('About Us Page') }}
                </button>
            </h2>
        </div>

        <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionExample">
            <div class="card-body">

                @bsMultilangualFormTabs
                    <div class="row">
                        <div class="col-6">
                            {{ BsForm::text('about_seo_title')->value(Settings::locale($locale->code)->get('about_seo_title'))->label(__('About Us SEO Title')) }}
                        </div>
                        <div class="col-6">
                            {{ BsForm::text('about_seo_keywords')->value(Settings::locale($locale->code)->get('about_seo_keywords'))->label(__('About Us SEO Keywords')) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            {{ BsForm::textarea('about_seo_description')->value(Settings::locale($locale->code)->get('about_seo_description'))->rows(3)->label(__('About Us SEO Description')) }}
                        </div>
                    </div>
                @endBsMultilangualFormTabs

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="heading7">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                    # {{ __('Projects Page') }}
                </button>
            </h2>
        </div>

        <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordionExample">
            <div class="card-body">

                @bsMultilangualFormTabs
                    <div class="row">
                        <div class="col-6">
                            {{ BsForm::text('projects_seo_title')->value(Settings::locale($locale->code)->get('projects_seo_title'))->label(__('Projects SEO Title')) }}
                        </div>
                        <div class="col-6">
                            {{ BsForm::text('projects_seo_keywords')->value(Settings::locale($locale->code)->get('projects_seo_keywords'))->label(__('Projects SEO Keywords')) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            {{ BsForm::textarea('projects_seo_description')->value(Settings::locale($locale->code)->get('projects_seo_description'))->rows(3)->label(__('Projects SEO Description')) }}
                        </div>
                    </div>
                @endBsMultilangualFormTabs

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="heading8">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
                    # {{ __('Terms Page') }}
                </button>
            </h2>
        </div>

        <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordionExample">
            <div class="card-body">

                @bsMultilangualFormTabs
                    <div class="row">
                        <div class="col-6">
                            {{ BsForm::text('terms_seo_title')->value(Settings::locale($locale->code)->get('terms_seo_title'))->label(__('Terms SEO Title')) }}
                        </div>
                        <div class="col-6">
                            {{ BsForm::text('terms_seo_keywords')->value(Settings::locale($locale->code)->get('terms_seo_keywords'))->label(__('Terms SEO Keywords')) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            {{ BsForm::textarea('terms_seo_description')->value(Settings::locale($locale->code)->get('terms_seo_description'))->rows(3)->label(__('Terms SEO Description')) }}
                        </div>
                    </div>
                @endBsMultilangualFormTabs
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="heading9">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
                    # {{ __('Privacy Policy Page') }}
                </button>
            </h2>
        </div>

        <div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#accordionExample">
            <div class="card-body">

                @bsMultilangualFormTabs
                    <div class="row">
                        <div class="col-6">
                            {{ BsForm::text('privacy_seo_title')->value(Settings::locale($locale->code)->get('privacy_seo_title'))->label(__('Privacy Policy SEO Title')) }}
                        </div>
                        <div class="col-6">
                            {{ BsForm::text('privacy_seo_keywords')->value(Settings::locale($locale->code)->get('privacy_seo_keywords'))->label(__('Privacy Policy SEO Keywords')) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            {{ BsForm::textarea('privacy_seo_description')->value(Settings::locale($locale->code)->get('privacy_seo_description'))->rows(3)->label(__('Privacy Policy SEO Description')) }}
                        </div>
                    </div>
                @endBsMultilangualFormTabs

            </div>
        </div>
    </div>

</div>
