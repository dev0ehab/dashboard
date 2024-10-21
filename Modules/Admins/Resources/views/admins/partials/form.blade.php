@include('dashboard::errors')
{{ BsForm::text('name')->required()->attribute(['data-parsley-maxlength' => '191','data-parsley-minlength' => '3']) }}
{{ BsForm::email('email')->required()->attribute(['data-parsley-type' => 'email','data-parsley-minlength' => '3']) }}
{{ BsForm::password('password') }}
{{ BsForm::password('password_confirmation') }}


@if(\Module::collections()->has('Roles'))
    <select2 name="role_id"
            label="@lang('roles::roles.singular')"
            remote-url="{{ route('roles.select') }}"
            @isset($admin)
            value="{{ $admin->roles()->orderBy('id','desc')->first()->id ?? old('role_id') }}"
            @endisset
            :required="true"
    ></select2>
@endif
{{-- @isset($admin)
    {{ BsForm::image('avatar')->collection('avatars')->files($admin->getMediaResource('avatars'))->notes(trans('admins::admins.messages.images_note')) }}
@else
    {{ BsForm::image('avatar')->collection('avatars')->notes(trans('admins::admins.messages.images_note')) }}
@endisset --}}

<label>{{ __('admins::admins.attributes.avatar') }}</label>
@isset($admin)
    <input type="file" name="avatar" class="dropify" data-default-file="{{ $admin->getFirstMediaUrl('avatars') }}" />
@else
    <input type="file" name="avatar" class="dropify" data-height="200" multiple />
@endisset

@push('js')
    <script>
        $('.dropify').dropify();
    </script>
@endpush
