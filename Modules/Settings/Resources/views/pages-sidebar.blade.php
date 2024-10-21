@component('dashboard::layouts.components.sidebarItem')
    @slot('can', ['permission' => 'read_settings'])
    @slot('url', route('dashboard.settings.index'))
    @slot('name', trans('Pages'))
    @slot('isActive', request()->routeIs('*pages*'))
    @slot('icon', 'fas fa-file-alt')
    @php(
    $trees = [
        [
            'name' => trans('Home'),
            'url' => route('dashboard.pages.home'),
            'can' => ['permission' => 'read_settings'],
            'isActive' => request()->routeIs('dashboard.pages.home'),
            'module' => 'Settings',
        ],
        [
            'name' => trans('Static Pages'),
            'url' => route('dashboard.pages.static-pages'),
            'can' => ['permission' => 'read_settings'],
            'isActive' => request()->routeIs('dashboard.pages.static-pages'),
            'module' => 'Settings',
        ],
        // [
        //     'name' => trans('Services'),
        //     'url' => route('dashboard.pages.services'),
        //     'can' => ['permission' => 'read_settings'],
        //     'isActive' => request()->routeIs('dashboard.pages.services'),
        //     'module' => 'Settings',
        // ],
    ]
)
    @slot('tree', $trees)
@endcomponent
