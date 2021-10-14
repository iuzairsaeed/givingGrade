<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'plan-getList',
            'plan-list',
            'plan-create',
            'plan-edit',
            'plan-delete',
            'settings-getList',
            'settings-list',
            'settings-create',
            'settings-edit',
            'settings-delete',
            'notifications-getList',
            'notifications-list',
            'notifications-create',
            'notifications-edit',
            'notifications-delete',
            'citizen-getList',
            'citizen-list',
            'citizen-create',
            'citizen-edit',
            'citizen-delete',
            'SecurityQuestion-getList',
            'SecurityQuestion-list',
            'SecurityQuestion-create',
            'SecurityQuestion-edit',
            'SecurityQuestion-delete',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
