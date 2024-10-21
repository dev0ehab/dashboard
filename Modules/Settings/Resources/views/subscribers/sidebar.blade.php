@component('dashboard::layouts.components.sidebarItem')
    @slot('can', ['permission' => 'read_subscribers'])
    @slot('url', route('dashboard.subscribers.index'))
    @slot('name', trans('settings::subscribers.plural'))
    @slot('isActive', request()->routeIs('*subscribers*'))
    @slot('icon', 'fas fa-user-tag')
    @slot('tree', [
        [
            'name' => trans('settings::subscribers.actions.list'),
            'url' => route('dashboard.subscribers.index'),
            'can' => ['permission' => 'read_subscribers'],
            'isActive' => request()->routeIs('*subscribers.index'),
            'module' => 'Settings',
        ]
    ])
@endcomponent
