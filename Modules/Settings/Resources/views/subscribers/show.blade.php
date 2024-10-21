@extends('dashboard::layouts.default')

@section('title')
    {{ $subscriber->name }}
@endsection
@section('content')
    @component('dashboard::layouts.components.page')
        @slot('title', $subscriber->name)
        @slot('breadcrumbs', ['dashboard.subscribers.show', $subscriber])

        <div class="row">
            <div class="col-md-6">
                @component('dashboard::layouts.components.box')
                    @slot('bodyClass', 'p-0')

                    <table class="table table-middle">
                        <tbody>
                        <tr>
                            <th width="200">@lang('settings::subscribers.attributes.name')</th>
                            <td>{{ $subscriber->name }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('settings::subscribers.attributes.email')</th>
                            <td>{{ $subscriber->email }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('settings::subscribers.attributes.phone')</th>
                            <td>{{ $subscriber->phone }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('settings::subscribers.attributes.exhibition')</th>
                            <td>{{ $subscriber->exhibition->name }}</td>
                        </tr>

                        </tbody>
                    </table>

                    @slot('footer')
                        @include('settings::subscribers.actions.delete')
                    @endslot
                @endcomponent
            </div>
        </div>

    @endcomponent
@endsection
