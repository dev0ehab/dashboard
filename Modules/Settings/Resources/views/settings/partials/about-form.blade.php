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
        <div class="card-header" id="heading1">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                    # {{ __('About Us Section') }}
                </button>
            </h2>
        </div>

        <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionExample">
            <div class="card-body">

                @bsMultilangualFormTabs
                    {{ BsForm::textarea('about_us_desc')->value(Settings::locale($locale->code)->get('about_us_desc'))->attribute('class', 'form-control textarea')->rows(4)->attribute(['data-parsley-minlength' => '3'])->label(__('settings::settings.attributes.about_us_desc')) }}
                @endBsMultilangualFormTabs

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="heading2">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                    # {{ __('Our Vision Section') }}
                </button>
            </h2>
        </div>

        <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        @bsMultilangualFormTabs
                            {{ BsForm::textarea('our_vision')->value(Settings::locale($locale->code)->get('our_vision'))->attribute('class', 'form-control textarea')->rows(4)->attribute(['data-parsley-minlength' => '3'])->label(__('settings::settings.attributes.our_vision')) }}
                        @endBsMultilangualFormTabs
                    </div>
                    <div class="col-md-12">
                        <label>{{ __('Vision Cover') }}</label>
                        @include('dashboard::layouts.apps.file', [
                            'file' => optional(Settings::instance('vision_cover'))->getFirstMediaUrl(
                                'vision_cover'),
                            'name' => 'vision_cover',
                        ])
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="heading">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                    # {{ __('Our Mission Section') }}
                </button>
            </h2>
        </div>

        <div id="collapse3" class="collapse" aria-labelledby="heading" data-parent="#accordionExample">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        @bsMultilangualFormTabs
                            {{ BsForm::textarea('our_mission')->value(Settings::locale($locale->code)->get('our_mission'))->attribute('class', 'form-control textarea')->rows(4)->attribute(['data-parsley-minlength' => '3'])->label(__('settings::settings.attributes.our_mission')) }}
                        @endBsMultilangualFormTabs
                    </div>
                    <div class="col-md-12">
                        <label>{{ __('Mission Cover') }}</label>
                        @include('dashboard::layouts.apps.file1', [
                            'file' => optional(Settings::instance('mission_cover'))->getFirstMediaUrl(
                                'mission_cover'),
                            'name' => 'mission_cover',
                        ])
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
                    # {{ __('Our Goals Section') }}
                </button>
            </h2>
        </div>

        <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionExample">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">

                        @bsMultilangualFormTabs
                            {{ BsForm::textarea('our_goals')->value(Settings::locale($locale->code)->get('our_goals'))->attribute('class', 'form-control textarea')->rows(4)->attribute(['data-parsley-minlength' => '3'])->label(__('settings::settings.attributes.our_goals')) }}
                        @endBsMultilangualFormTabs

                    </div>
                    <div class="col-md-12">
                        <label>{{ __('goals Cover') }}</label>
                        @include('dashboard::layouts.apps.file1', [
                            'file' => optional(Settings::instance('goals_cover'))->getFirstMediaUrl('goals_cover'),
                            'name' => 'goals_cover',
                        ])
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>



<div class="card-body">
    {{-- {{ BsForm::text('address')->required()->attribute('class', 'form-control')->value(Settings::get('address'))->attribute(['data-parsley-minlength' => '3'])->label(__('settings::settings.attributes.address')) }} --}}

    {{-- {{ BsForm::text('office_address')->required()->attribute('class', 'form-control')->value(Settings::get('office_address'))->attribute(['data-parsley-minlength' => '3'])->label(__('Office Address')) }} --}}

    {{-- {{ BsForm::text('about_us_title')->required()->attribute('class', 'form-control')->value(Settings::get('about_us_title'))->label(__('settings::settings.attributes.about_us_title')) }} --}}

    {{-- {{ BsForm::textarea('about_us_desc')->required()->attribute('class', 'form-control textarea')->rows(4)->value(Settings::get('about_us_desc'))->attribute(['data-parsley-minlength' => '3'])->label(__('settings::settings.attributes.about_us_desc')) }} --}}

    {{-- {{ BsForm::textarea('our_vision')->required()->rows(3)->attribute('class', 'form-control')->value(Settings::get('our_vision'))->attribute(['data-parsley-minlength' => '3'])->label(__('settings::settings.attributes.our_vision')) }}

    {{ BsForm::textarea('our_mission')->required()->rows(3)->attribute('class', 'form-control')->value(Settings::get('our_mission'))->attribute(['data-parsley-minlength' => '3'])->label(__('settings::settings.attributes.our_mission')) }} --}}






    {{-- <div class="row">
        <div class="col-md-12">
            {{ BsForm::text('founder_words_title')->required()->attribute('class', 'form-control')->value(Settings::get('founder_words_title'))->attribute(['data-parsley-minlength' => '3'])->label(__('Founder Words Title')) }}
        </div>
        <div class="col-md-12">
            {{ BsForm::textarea('founder_words')->required()->attribute('class', 'form-control textarea')->rows(4)->value(Settings::get('founder_words'))->attribute(['data-parsley-minlength' => '3'])->label(__('Founder Words')) }}
        </div>

        <div class="col-md-12">
            <label>{{ __('Founder Words Image') }}</label>
            @include('dashboard::layouts.apps.file1', [
                'file' => optional(Settings::instance('owner'))->getFirstMediaUrl('owner'),
                'name' => 'owner',
            ])
        </div>
    </div> --}}

    {{-- </div> --}}
