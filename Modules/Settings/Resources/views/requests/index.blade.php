@extends('dashboard::layouts.default')

@section('title')
    Contacts
@endsection

@section('content')
    @component('dashboard::layouts.components.page')
        @slot('title', 'Contacts')
        @slot('breadcrumbs', ['dashboard.home'])
        @include('dashboard::layouts.apps.datatables')
        {{-- @include('roles::roles.partials.filter') --}}
        @component('dashboard::layouts.components.table-box')
            @slot('title', 'Contacts')
            @slot('tools')
            @endslot

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Nationality</th>
                    <th>Profession</th>
                    <th>Reference Number</th>
                    <th>From Where</th>
                    {{-- <th>Attending</th> --}}
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr>
                        <td class="d-none d-md-table-cell">
                            {{ $contact->name }}
                        </td>
                        <td class="d-none d-md-table-cell">
                            {{ $contact->email }}
                        </td>
                        <td class="d-none d-md-table-cell">
                            {{ $contact->phone_number }}
                        </td>
                        <td class="d-none d-md-table-cell">
                            {{ $contact->nationality }}
                        </td>
                        <td class="d-none d-md-table-cell">
                            {{ $contact->profession }}
                        </td>
                        <td class="d-none d-md-table-cell">
                            {{ $contact->reference_num }}
                        </td>
                        <td class="d-none d-md-table-cell">
                            {{ $contact->reason->reason }}
                        </td>
                        {{-- <td class="d-none d-md-table-cell">
                            @if ($contact->attended)
                                <span class="badge badge-success">
                                    Yes
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    No
                                </span>
                            @endif
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="100" class="text-center">No Contacts Yet</td>
                    </tr>
                @endforelse
            @endcomponent
        @endcomponent
    @endsection
