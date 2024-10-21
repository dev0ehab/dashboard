@component('dashboard::layouts.components.sidebarItem')
    @slot('can', ['permission' => 'read_admins'])
    @slot('url', route('dashboard.admins.index'))
    @slot('name', trans('admins::admins.plural'))
    @slot('isActive', request()->routeIs('*admins*'))
    @slot('icon', 'fas fa-users-cog')
    @slot('tree', [
        [
            'name' => trans('admins::admins.actions.list'),
            'url' => route('dashboard.admins.index'),
            'can' => ['permission' => 'read_admins'],
            'isActive' => request()->routeIs('*admins.index'),
            'module' => 'Admins',
        ],
        [
            'name' => trans('admins::admins.actions.create'),
            'url' => route('dashboard.admins.create'),
            'can' => ['permission' => 'create_admins'],
            'isActive' => request()->routeIs('*admins.create'),
            'module' => 'Admins',
        ],
    ])
@endcomponent
