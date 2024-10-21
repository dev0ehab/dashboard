@extends('dashboard::layouts.default')

@section('title')
    @lang('admins::user.actions.create')
@endsection

@section('content')
    @component('dashboard::layouts.components.page')
        @slot('title', trans('admins::user.plural'))
        @slot('breadcrumbs', ['dashboard.users.create'])

        {{ BsForm::resource('admins::users')->post(route('dashboard.users.store'), ['files' => true,'data-parsley-validate']) }}
        @component('dashboard::layouts.components.box')
            @slot('title', trans('admins::user.actions.create'))

            @include('admins::users.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('admins::user.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection

