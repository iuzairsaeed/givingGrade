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
            'name' => 'Uzair Saeed',
            'username' => 'uzair',
            'email' => 'uzair@gg.com',
            'is_admin' => true,
            'password' => Hash::make('secret'),
            'created_at' => now()
        ]);
        $role = Role::Where('name', 'admin')->first();
        $admin->assignRole([$role->id]);

        $user = User::create([
            'name' => 'Murtuza Mehdi',
            'username' => 'murtuza',
            'email' => 'murtuza@gg.com',
            'is_admin' => false,
            'password' => Hash::make('secret'),
            'created_at' => now()
        ]);
        $roleN = Role::where('name', 'normal')->first();
        $user->assignRole([$roleN->id]);
    }
}
