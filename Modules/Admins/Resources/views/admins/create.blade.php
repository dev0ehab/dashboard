@extends('dashboard::layouts.default')

@section('title')
    @lang('admins::admins.actions.create')
@endsection

@section('content')
    @component('dashboard::layouts.components.page')
        @slot('title', trans('admins::admins.plural'))
        @slot('breadcrumbs', ['dashboard.admins.create'])

        {{ BsForm::resource('admins::admins')->post(route('dashboard.admins.store'), ['files' => true,'data-parsley-validate']) }}
        @component('dashboard::layouts.components.box')
            @slot('title', trans('admins::admins.actions.create'))

            @include('admins::admins.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('admins::admins.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection

