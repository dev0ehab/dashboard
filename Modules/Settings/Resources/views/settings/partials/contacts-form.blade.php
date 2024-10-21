@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{ BsForm::text('email')->value(Settings::get('email')) }}
{{ BsForm::text('phone')->value(Settings::get('phone')) }}
{{ BsForm::text('mobile')->value(Settings::get('mobile')) }}
{{ BsForm::text('whats_app')->value(Settings::get('whats_app')) }}
