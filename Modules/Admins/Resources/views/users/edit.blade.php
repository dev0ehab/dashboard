@extends('dashboard::layouts.default')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
    @component('dashboard::layouts.components.page')
        @slot('title', $user->name)
        @slot('breadcrumbs', ['dashboard.users.edit', $user])

        {{ BsForm::resource('admins::users')->putModel($user, route('dashboard.users.update', $user), ['files' => true,'data-parsley-validate']) }}
        @component('dashboard::layouts.components.box')
            @slot('title', trans('admins::user.actions.edit'))

            @include('admins::users.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('admins::user.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
