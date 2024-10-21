@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{{ BsForm::text('name')->value(Settings::get('name'))->attribute(['data-parsley-maxlength' => '191', 'data-parsley-minlength' => '3']) }}
{{ BsForm::textarea('description')->rows(3)->attribute('class', 'form-control textarea')->value(Settings::get('description'))->attribute(['data-parsley-minlength' => '3']) }}
{{ BsForm::text('trade_register')->value(Settings::get('trade_register'))->label(trans('settings::settings.attributes.trade_register'))->attribute(['data-parsley-type' => 'number', 'data-parsley-trigger' => 'keyup']) }}

{{-- {{ BsForm::text('cand_address')->value(Settings::get('cand_address'))->label('Canda Address') }} --}}
{{-- <div class="row">
    <div class="col-md-6">
        {{ BsForm::image('logo')->collection('logo')->files(optional(Settings::instance('logo'))->getMediaResource('logo'))->notes(trans('settings::settings.messages.images_note')) }}
    </div>
    <div class="col-md-6">
        {{ BsForm::image('favicon')->collection('favicon')->files(optional(Settings::instance('favicon'))->getMediaResource('favicon'))->notes(trans('settings::settings.messages.images_note')) }}
    </div>
    <div class="col-md-6">
        {{ BsForm::image('loginLogo')->collection('loginLogo')->files(optional(Settings::instance('loginLogo'))->getMediaResource('loginLogo')) }}
    </div>
    <div class="col-md-6">
        {{ BsForm::image('loginBackground')->collection('loginBackground')->files(optional(Settings::instance('loginBackground'))->getMediaResource('loginBackground')) }}
    </div>
    <div class="col-md-6">
        {{ BsForm::image('cover')->collection('cover')->files(optional(Settings::instance('cover'))->getMediaResource('cover')) }}
    </div>
</div> --}}

{{--    <select2 name="privacy_policy" --}}
{{--             label="@lang('settings::settings.attributes.privacy_policy')" --}}
{{--             remote-url="{{ route('pages.select') }}" --}}
{{--             value="{{ (new Modules\Settings\Entities\Setting)->get('privacy_policy', old('privacy_policy',null)) }}" --}}
{{--             :required="false" --}}
{{--    ></select2> --}}

{{--    <select2 name="terms" --}}
{{--             label="@lang('settings::settings.attributes.terms')" --}}
{{--             remote-url="{{ route('pages.select') }}" --}}
{{--             value="{{ (new Modules\Settings\Entities\Setting)->get('terms', old('terms',null)) }}" --}}
{{--             :required="false" --}}
{{--    ></select2> --}}

<div class="row mb-3">
    <div class="col-md-6">
        <label>{{ __('settings::settings.attributes.logo') }}</label>
        @include('dashboard::layouts.apps.file', [
            'file' => optional(Settings::instance('logo'))->getFirstMediaUrl('logo'),
            'name' => 'logo',
        ])
    </div>
    <div class="col-md-6">
        <label>{{ __('settings::settings.attributes.favicon') }}</label>
        @include('dashboard::layouts.apps.file', [
            'file' => optional(Settings::instance('favicon'))->getFirstMediaUrl('favicon'),
            'name' => 'favicon',
        ])
    </div>
    <div class="col-md-6">
        <label>{{ __('settings::settings.attributes.loginLogo') }}</label>
        @include('dashboard::layouts.apps.file', [
            'file' => optional(Settings::instance('loginLogo'))->getFirstMediaUrl('loginLogo'),
            'name' => 'loginLogo',
        ])
    </div>
    <div class="col-md-6">
        <label>{{ __('settings::settings.attributes.loginBackground') }}</label>
        @include('dashboard::layouts.apps.file', [
            'file' => optional(Settings::instance('loginBackground'))->getFirstMediaUrl('loginBackground'),
            'name' => 'loginBackground',
        ])
    </div>
    <div class="col-md-6">
        <label>{{ __('settings::settings.attributes.qr') }}</label>
        @include('dashboard::layouts.apps.file', [
            'file' => optional(Settings::instance('qr'))->getFirstMediaUrl('qr'),
            'name' => 'qr',
        ])
    </div>
    <div class="col-md-6">
        <label>{{ __('settings::settings.attributes.site_pdf') }}</label>
        @include('dashboard::layouts.apps.file', [
            'file' => optional(Settings::instance('site_pdf'))->getFirstMediaUrl('site_pdf'),
            'name' => 'site_pdf',
        ])
    </div>
</div>
