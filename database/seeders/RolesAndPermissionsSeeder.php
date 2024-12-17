<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'manage_users_permissions' => ['view users', 'edit users', 'delete users', 'add users'],
            'manage_accounts_permissions' => ['view accounts', 'edit accounts', 'delete accounts', 'add accounts'],
            'manage_products_permissions' => ['view products', 'edit products', 'delete products', 'add products'],
            'manage_categories_permissions' => ['view categories', 'edit categories', 'delete categories', 'add categories'],
        ];

        foreach ($permissions as $items) {
            foreach ($items as $permission) {
                Permission::updateOrCreate(['name' => $permission]);
            }
        }

        $superAdminRole = Role::updateOrCreate(['name' => 'Super Admin']);
        $adminRole = Role::updateOrCreate(['name' => 'Admin']);

        $superAdminRole->givePermissionTo($permissions['manage_users_permissions']);
        $superAdminRole->givePermissionTo($permissions['manage_accounts_permissions']);
        $superAdminRole->givePermissionTo($permissions['manage_products_permissions']);
        $superAdminRole->givePermissionTo($permissions['manage_categories_permissions']);
    }
}
