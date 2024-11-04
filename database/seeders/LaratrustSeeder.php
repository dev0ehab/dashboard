<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Roles\Entities\Permission;
use Modules\Roles\Entities\Role;
use Modules\Admins\Database\Seeders\AdminsTableSeeder;
use Modules\Admins\Entities\Admin;

class LaratrustSeeder extends Seeder
{

    /**
     * Run the database seeds for Laratrust roles and permissions.
     *
     * This function truncates the Laratrust tables, retrieves the configuration
     * for roles and permissions, and creates roles with their associated permissions
     * based on the configuration. If the configuration is not published, it outputs
     * an error message. Additionally, it seeds the AdminsTableSeeder if configured
     * to create users.
     *
     * @return void|bool Returns false if the configuration is not published.
     */
    public function run()
    {
        $this->truncateLaratrustTables();

        $config = Config::get('laratrust_seeder.roles_structure');

        if ($config === null) {
            $this->command->error("The configuration has not been published. Did you run `php artisan vendor:publish --tag=\"laratrust-seeder\"`");
            $this->command->line('');
            return false;
        }

        $mapPermission = collect(config('laratrust_seeder.permissions_map'));

        foreach ($config as $key => $modules) {

            // Create a new role
            $role = Role::whereName([
                'name' => $key
            ])->first();

            if (!$role) {
                $role = Role::create([
                    'name' => $key,
                    'display_name:ar' => trans("roles::roles.role_map.$key", [], 'ar'),
                    'display_name:en' => trans("roles::roles.role_map.$key", [], 'en'),
                    'description' => ucwords(str_replace('_', ' ', $key))
                ]);
            }


            $permissions = [];

            $this->command->info('Creating Role ' . strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {

                foreach (explode(',', $value) as $p => $perm) {

                    $permissionValue = $mapPermission->get($perm);
                    $permissions[] = Permission::create([
                        'name' => $permissionValue . '_' . $module,
                        'display_name:en' => trans("roles::roles.permission_map.$permissionValue", ['module' => trans("$module::$module.singular" , [], 'en')], 'en'),
                        'display_name:ar' => trans("roles::roles.permission_map.$permissionValue", ['module' => trans("$module::$module.singular" , [], 'ar')], 'ar'),
                        'module' => $module,
                    ])->id;

                    $this->command->info('Creating Permission to ' . $permissionValue . ' for ' . $module);
                }
            }

            // Attach all permissions to the role
            $role->permissions()->sync($permissions);
        }
        if (Config::get('laratrust_seeder.create_users')) {
            $this->call(AdminsTableSeeder::class);
        }
    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return  void
     */
    public function truncateLaratrustTables()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        Schema::disableForeignKeyConstraints();

        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        // DB::table('role_user')->truncate();

        if (Config::get('laratrust_seeder.truncate_tables')) {
            DB::table('roles')->truncate();
            DB::table('permissions')->truncate();

            if (Config::get('laratrust_seeder.create_users')) {
                $usersTable = (new Admin)->getTable();
                DB::table($usersTable)->truncate();
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
