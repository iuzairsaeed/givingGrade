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
            $permissionsN = Permission::whereIn('name',$teacherPermission)->pluck('id');
            $roleTeacher->syncPermissions($permissionsN);
        }


        // Role Corporate
        $corporateExist = Role::where('name','corporate')->first();
        if(!$corporateExist) {
            $roleCorporate = Role::create(['name' => 'corporate']);
            $corporatePermission = [
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
            $permissionsN = Permission::whereIn('name',$corporatePermission)->pluck('id');
            $roleCorporate->syncPermissions($permissionsN);
        }



        // Role Private
        $privateExist = Role::where('name','private')->first();
        if(!$privateExist) {
            $rolePrivate = Role::create(['name' => 'private']);
            $privatePermission = [
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
                'user-list',
            ];
            $permissionsN = Permission::whereIn('name',$privatePermission)->pluck('id');
            $rolePrivate->syncPermissions($permissionsN);
        }
    }
}
