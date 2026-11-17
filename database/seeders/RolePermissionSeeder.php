<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Seed default roles, permissions, and user management menus.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'menus.view',
            'menus.create',
            'menus.edit',
            'menus.delete',
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $superAdmin = Role::findOrCreate('super-admin', 'web');
        $superAdmin->syncPermissions($permissions);

        $admin = Role::findOrCreate('admin', 'web');
        $admin->syncPermissions([
            'menus.view',
            'menus.create',
            'menus.edit',
            'users.view',
            'users.create',
            'users.edit',
            'roles.view',
        ]);

        Role::findOrCreate('user', 'web');

        $this->seedSidebarMenus();
    }

    /**
     * Ensure User Management (Users & Roles) menus exist in sidebar.
     */
    private function seedSidebarMenus(): void
    {
        $userManagement = Menu::query()->firstOrCreate(
            ['title' => 'User Management', 'parent_id' => null],
            [
                'type' => Menu::TypeItem,
                'icon' => 'bi bi-people-fill',
                'route_pattern' => 'users.*,roles.*',
                'order' => 4,
                'is_active' => true,
            ],
        );

        Menu::query()->firstOrCreate(
            ['route_name' => 'users.index', 'parent_id' => $userManagement->id],
            [
                'type' => Menu::TypeItem,
                'title' => 'Users',
                'route_pattern' => 'users.*',
                'order' => 1,
                'is_active' => true,
            ],
        );

        Menu::query()->firstOrCreate(
            ['route_name' => 'roles.index', 'parent_id' => $userManagement->id],
            [
                'type' => Menu::TypeItem,
                'title' => 'Roles',
                'route_pattern' => 'roles.*',
                'order' => 2,
                'is_active' => true,
            ],
        );
    }
}
