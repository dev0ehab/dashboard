{{-- @component('dashboard::layouts.components.sidebarItem')
    @slot('can', ['permission' => 'read_settings'])
    @slot('url', route('dashboard.contact-requests'))
    @slot('name', "Contacts")
    @slot('isActive', request()->routeIs('dashboard.contact-requests'))
    @slot('icon', 'fas fa-address-card')
@endcomponent
 --}}

@component('dashboard::layouts.components.sidebarItem')
    @slot('can', ['permission' => 'read_settings'])
    @slot('url', route('dashboard.contact-requests'))
    @slot('name', "Registration")
    @slot('isActive', request()->routeIs('dashboard.contact-requests'))
    @slot('icon', 'fas fa-address-card')
    @slot('tree', [
        [
            'name' => trans('Registration'),
            'url' => route('dashboard.contact-requests'),
            'can' => ['permission' => 'read_settings'],
            'isActive' => request()->routeIs('dashboard.contact-requests'),
            'module' => 'Settings',
        ],
        [
            'name' => trans('howknow::reasons.reason'),
            'url' => route('dashboard.reasons.index'),
            'can' => ['permission' => 'read_reasons'],
            'isActive' => request()->routeIs('*reasons.index'),
            'module' => 'HowKnow',
        ],
    ])
@endcomponent
