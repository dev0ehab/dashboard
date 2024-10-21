@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($page == 'home')

    <div class="accordion" id="accordionExample">

        <div class="card">
            <div class="card-header" id="heading2">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                        data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                        # {{ __('About') }}
                    </button>
                </h2>
            </div>

            <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample">
                <div class="card-body">
                    @bsMultilangualFormTabs
                        {{ BsForm::textarea('about_header')->rows(2)->attribute('class', 'form-control textarea')->value(Settings::locale($locale->code)->get('about_header'))->label(__('About Header')) }}
                        {{ BsForm::textarea('about_desc')->rows(3)->attribute('class', 'form-control textarea')->value(Settings::locale($locale->code)->get('about_desc'))->label(__('About Description')) }}
                    @endBsMultilangualFormTabs

                    <div class="col-md-12">
                        <label>{{ __('About Image') }}</label>
                        @include('dashboard::layouts.apps.file', [
                            'file' => optional(Settings::instance('about_image'))->getFirstMediaUrl('about_image'),
                            'name' => 'about_image',
                        ])
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="heading3">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                        data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                        # {{ __('Latest Projects') }}
                    </button>
                </h2>
            </div>

            <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionExample">
                <div class="card-body">
                    @bsMultilangualFormTabs
                        {{ BsForm::textarea('project_header')->rows(3)->attribute('class', 'form-control textarea')->value(Settings::locale($locale->code)->get('project_header'))->label(__('Projects Header')) }}
                    @endBsMultilangualFormTabs

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="heading4">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                        data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                        # {{ __('Packages') }}
                    </button>
                </h2>
            </div>

            <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionExample">
                <div class="card-body">
                    @bsMultilangualFormTabs
                        {{ BsForm::textarea('package_header')->rows(3)->attribute('class', 'form-control textarea')->value(Settings::locale($locale->code)->get('package_header'))->label(__('Packages Header')) }}
                    @endBsMultilangualFormTabs

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="heading5">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                        data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                        # {{ __('Our Clients') }}
                    </button>
                </h2>
            </div>

            <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionExample">
                <div class="card-body">
                    @bsMultilangualFormTabs
                        {{ BsForm::textarea('client_header')->rows(3)->attribute('class', 'form-control textarea')->value(Settings::locale($locale->code)->get('client_header'))->label(__('Our Clients Header')) }}
                    @endBsMultilangualFormTabs

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="heading6">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                        data-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                        # {{ __('Our Service') }}
                    </button>
                </h2>
            </div>

            <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordionExample">
                <div class="card-body">
                    @bsMultilangualFormTabs
                        {{ BsForm::textarea('service_header')->rows(3)->attribute('class', 'form-control textarea')->value(Settings::locale($locale->code)->get('service_header'))->label(__('Our Service Header')) }}
                    @endBsMultilangualFormTabs

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="heading7">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                        data-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                        # {{ __('Our Team') }}
                    </button>
                </h2>
            </div>

            <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordionExample">
                <div class="card-body">
                    @bsMultilangualFormTabs
                        {{ BsForm::textarea('team_header')->rows(3)->attribute('class', 'form-control textarea')->value(Settings::locale($locale->code)->get('team_header'))->label(__('Our Team Header')) }}
                    @endBsMultilangualFormTabs

                </div>
            </div>
        </div>

    </div>
@elseif ($page == 'staticPages')
    <div class="accordion" id="accordionExample">

        <div class="card">
            <div class="card-header" id="heading1">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                        data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                        # {{ __('policy') }}
                    </button>
                </h2>
            </div>

            <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionExample">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            @bsMultilangualFormTabs
                                {{ BsForm::textarea('policy')->rows(3)->attribute('class', 'form-control textarea')->value(Settings::locale($locale->code)->get('policy'))->attribute(['data-parsley-minlength' => '3']) }}
                            @endBsMultilangualFormTabs

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="heading2">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                        data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                        # {{ __('terms') }}
                    </button>
                </h2>
            </div>

            <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            @bsMultilangualFormTabs
                                {{ BsForm::textarea('terms')->rows(3)->attribute('class', 'form-control textarea')->value(Settings::locale($locale->code)->get('terms'))->attribute(['data-parsley-minlength' => '3']) }}
                            @endBsMultilangualFormTabs

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endif


@push('js')
    @include('settings::settings.includes.scripts')
@endpush
