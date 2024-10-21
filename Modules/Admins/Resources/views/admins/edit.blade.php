@extends('dashboard::layouts.default')

@section('title')
    {{ $admin->name }}
@endsection

@section('content')
    @component('dashboard::layouts.components.page')
        @slot('title', $admin->name)
        @slot('breadcrumbs', ['dashboard.admins.edit', $admin])

        {{ BsForm::resource('admins::admins')->putModel($admin, route('dashboard.admins.update', $admin), ['files' => true,'data-parsley-validate']) }}
        @component('dashboard::layouts.components.box')
            @slot('title', trans('admins::admins.actions.edit'))

            @include('admins::admins.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('admins::admins.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
