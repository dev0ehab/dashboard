@include('dashboard::errors')
{{ BsForm::text('name')->required()->attribute(['data-parsley-maxlength' => '191', 'data-parsley-minlength' => '3'])->label(trans('admins::user.attributes.name')) }}
{{ BsForm::email('email')->required()->attribute(['data-parsley-type' => 'email', 'data-parsley-minlength' => '3'])->label(trans('admins::user.attributes.email')) }}
{{ BsForm::text('phone')->required()->attribute(['data-parsley-type' => 'number', 'data-parsley-minlength' => '3'])->label(trans('admins::user.attributes.phone')) }}

{{ BsForm::checkbox('can_access')->label(trans('admins::user.attributes.can_access'))->checked(old('can_access', $user->can_access ?? '')) }}
<div class="row" id="login"
     @isset($user) @if ($user->can_access != 1) style="display: none" @endif @else
     style="display: none" @endisset>

    <div class="col-12">
        {{ BsForm::text('username')->attribute(['data-parsley-maxlength' => '191', 'data-parsley-minlength' => '3'])->label(trans('admins::user.attributes.username')) }}
    </div>

    <div class="col-6">
        {{ BsForm::password('password')->label(trans('admins::user.attributes.password')) }}
    </div>
    <div class="col-6">
        {{ BsForm::password('password_confirmation')->label(trans('admins::user.attributes.password_confirmation')) }}
    </div>

</div>

@isset($user)
    {{ BsForm::image('avatar')->collection('avatars')->files($user->getMediaResource('avatars'))->notes(trans('admins::user.messages.images_note')) }}
@else
    {{ BsForm::image('avatar')->collection('avatars')->notes(trans('admins::user.messages.images_note')) }}
@endisset

{{--@push('js')--}}
{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $('[name="can_access"]').change(function(e) {--}}
{{--            e.preventDefault();--}}
{{--            var value = $('[name="can_access"]').is(':checked');--}}
{{--            if (value) {--}}
{{--                $("#login").show();--}}
{{--                $('input[name="username"], input[name="password"], input[name="password_confirmation"]')--}}
{{--                    .attr("required", true);--}}
{{--            } else {--}}
{{--                $("#login").hide();--}}
{{--                $('input[name="username"], input[name="password"], input[name="password_confirmation"]')--}}
{{--                    .val('').attr("required", false);--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
{{--@endpush--}}
