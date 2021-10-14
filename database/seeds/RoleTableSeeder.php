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
        $roleAdmin = Role::create(['name' => 'admin']);
        $permissions = Permission::pluck('id','id')->all();
        $roleAdmin->syncPermissions($permissions);
        
        // Role Normal
        $roleNormal = Role::create(['name' => 'normal']);
        $normalPermission = [  
            'plan-getList',
            'plan-list',
            'plan-create',
            'plan-edit',
            'plan-delete',
        ];
        $permissionsN = Permission::whereIn('name',$normalPermission)->pluck('id');
        $roleNormal->syncPermissions($permissionsN);
    }
}
