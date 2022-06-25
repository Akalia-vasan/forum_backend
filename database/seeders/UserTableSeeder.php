<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin', 
            'email' => 'admin@gmail.net',
            'password' => bcrypt('654321'),
            'email_verified_at' => '2022-06-25 08:38:38'
        ]);
    
        $role = Role::find(1);
     
        $permissions = Permission::where('guard_name', 'web')->pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}
