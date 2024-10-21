@extends('dashboard::layouts.default')

@section('title')
    {{ $admin->name }}
@endsection

@section('content')
    @component('dashboard::layouts.components.page')
        @slot('title', $admin->name)
        @slot('breadcrumbs', ['dashboard.admins.show', $admin])

        @component('dashboard::layouts.components.box')
            @slot('bodyClass', 'p-0')

            <table class="table table-middle">
                <tbody>
                <tr>
                    <th width="200">@lang('admins::admins.attributes.name')</th>
                    <td>{{ $admin->name }}</td>
                </tr>
                <tr>
                    <th width="200">@lang('admins::admins.attributes.email')</th>
                    <td>{{ $admin->email }}</td>
                </tr>
                {{-- <tr>
                    <th width="200">@lang('admins::admins.attributes.phone')</th>
                    <td>{{ $admin->phone }}</td>
                </tr> --}}
                <tr>
                    <th width="200">@lang('admins::admins.attributes.avatar')</th>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-70 symbol-sm flex-shrink-0">
                                <img class="" src="{{ $admin->getAvatar() }}" alt="{{ $admin->name }}" width="150px" height="150px">
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            @slot('footer')
                @include('admins::admins.partials.actions.edit')
                @include('admins::admins.partials.actions.delete')
                {{--                @include('admins::admins.partials.actions.block')--}}
            @endslot
        @endcomponent

    @endcomponent
@endsection
