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
            'subject-getList',
            'subject-list',
            'subject-create',
            'subject-edit',
            'subject-delete',
            'charity-getList',
            'charity-list',
            'charity-create',
            'charity-edit',
            'charity-delete',
            'goal-getList',
            'goal-list',
            'goal-create',
            'goal-edit',
            'goal-delete',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
