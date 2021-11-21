<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Role Admin
        $adminExist = Role::where('name','admin')->first();
        if(!$adminExist) {

            $roleAdmin = Role::create(['name' => 'admin']);
            $permissions = Permission::pluck('id','id')->all();
            $roleAdmin->syncPermissions($permissions);
        }

        // Role Teacher
        $teacherExist = Role::where('name','teacher')->first();
        if(!$teacherExist) {
            $roleTeacher = Role::create(['name' => 'teacher']);
            $teacherPermission = [
                'subject-getList',
                'subject-list',
                'charity-getList',
                'charity-list',
                'goal-getList',
                'goal-list',
                'goal-create',
                'goal-edit',
                'goal-delete',
                'user-delete',
                'classroom-getList',
                'classroom-list'
            ];
            $permissionsN = Permission::whereIn('name',$teacherPermission)->pluck('id');
            $roleTeacher->syncPermissions($permissionsN);
        }


        // Role Corporate
        $corporateExist = Role::where('name','sponsor')->first();
        if(!$corporateExist) {
            $roleCorporate = Role::create(['name' => 'sponsor']);
            $corporatePermission = [
                'charity-getList',
                'charity-list'
            ];
            $permissionsN = Permission::whereIn('name',$corporatePermission)->pluck('id');
            $roleCorporate->syncPermissions($permissionsN);
        }
    }
}
