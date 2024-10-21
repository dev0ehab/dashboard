@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{ BsForm::text('android_app_id')->value(Settings::get('android_app_id')) }}
{{ BsForm::text('ios_app_id')->value(Settings::get('ios_app_id')) }}
{{ BsForm::text('current_android_version')->value(Settings::get('current_android_version')) }}
{{ BsForm::text('current_ios_version')->value(Settings::get('current_ios_version')) }}
{{ BsForm::checkbox('android_force_update')->value(1)->checked(Settings::get('android_force_update') ?? old('android_force_update')) }}
{{ BsForm::checkbox('ios_force_update')->value(1)->checked(Settings::get('ios_force_update') ?? old('ios_force_update')) }}
