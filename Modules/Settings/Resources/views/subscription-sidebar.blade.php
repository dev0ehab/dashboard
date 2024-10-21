@component('dashboard::layouts.components.sidebarItem')
    @slot('can', ['permission' => 'read_settings'])
    @slot('url', route('dashboard.settings.index'))
    @slot('name', trans('Contact Us'))
    @slot('isActive', request()->routeIs('*contact-us*'))
    @slot('icon', 'fas fa-envelope')
    @php(
    $trees = [
        [
            'name' => trans('Inbox'),
            'url' => route('dashboard.contact-us.index'),
            'can' => ['permission' => 'read_contactus'],
            'isActive' => request()->routeIs('*contact-us.index'),
            'module' => 'Settings',
        ]
    ]
)
    @slot('tree', $trees)
@endcomponent
