@component('dashboard::layouts.components.sidebarItem')
    @slot('can', ['permission' => 'read_users'])
    @slot('url', route('dashboard.users.index'))
    @slot('name', trans('admins::user.plural'))
    @slot('isActive', request()->routeIs('*users*'))
    @slot('icon', 'fas fa-users')
    @slot('tree', [
        [
            'name' => trans('admins::user.actions.list'),
            'url' => route('dashboard.users.index'),
            'can' => ['permission' => 'read_users'],
            'isActive' => request()->routeIs('*users.index'),
            'module' => 'Admins',
        ],
        [
            'name' => trans('admins::user.actions.create'),
            'url' => route('dashboard.users.create'),
            'can' => ['permission' => 'create_users'],
            'isActive' => request()->routeIs('*users.create'),
            'module' => 'Admins',
        ],
    ])
@endcomponent
