<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('secret'),
            'is_admin' => true,
            'created_at' => now()
        ]);
        $role = Role::Where('name', 'admin')->first();
        $admin->assignRole([$role->id]);

        $user = User::create([
            'name' => 'Test Teacher',
            'email' => 'teacher@giving-grades.com',
            'password' => Hash::make('secret'),
            'is_admin' => false,
            'created_at' => now()
        ]);
        $roleN = Role::where('name', 'teacher')->first();
        $user->assignRole([$roleN->id]);

        $corporate = User::create([
            'name' => 'Test Corporate',
            'email' => 'corporate@giving-grades.com',
            'password' => Hash::make('secret'),
            'is_admin' => false,
            'created_at' => now()
        ]);
        $roleN = Role::where('name', 'sponsor')->first();
        $corporate->assignRole([$roleN->id]);

        $corporate = User::create([
            'name' => 'Test Private',
            'email' => 'private@giving-grades.com',
            'password' => Hash::make('secret'),
            'is_admin' => false,
            'created_at' => now()
        ]);
        $roleN = Role::where('name', 'sponsor')->first();
        $corporate->assignRole([$roleN->id]);
    }
}
