@extends('dashboard::layouts.default')

@section('title')
    @lang('settings::subscribers.plural')
@endsection

@section('content')
    @component('dashboard::layouts.components.page')
        @slot('title', trans('settings::subscribers.plural'))
        @slot('breadcrumbs', ['dashboard.subscribers.index'])

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @component('dashboard::layouts.components.table-box')
            @slot('title', trans('settings::subscribers.actions.list'))

            <thead>
                <tr>
                    <th>@lang('settings::subscribers.attributes.name')</th>
                    <th>@lang('settings::subscribers.attributes.email')</th>
                    <th>@lang('settings::subscribers.attributes.phone')</th>
                    <th>@lang('settings::subscribers.attributes.exhibition')</th>
                    <th style="width: 160px">...</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $subscriber)
                    <tr>
                        <td class="d-none d-md-table-cell">
                            {{ $subscriber->name }}
                        </td>
                        <td class="d-none d-md-table-cell">
                            {{ $subscriber->email }}
                        </td>
                        <td class="d-none d-md-table-cell">
                            {{ $subscriber->phone }}
                        </td>
                        <td class="d-none d-md-table-cell">
                            {{ $subscriber->exhibition->name }}
                        </td>

                        <td style="width: 160px">
                            @include('settings::subscribers.actions.show')
                            @include('settings::subscribers.actions.delete')
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100" class="text-center">@lang('settings::subscribers.empty')</td>
                    </tr>
                @endforelse

                @if ($data->hasPages())
                    @slot('footer')
                        {{ $data->links() }}
                    @endslot
                @endif
            @endcomponent
        @endcomponent
    @endsection
