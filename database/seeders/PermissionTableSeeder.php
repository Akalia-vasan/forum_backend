<?php

namespace Database\Seeders;

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
            'post-list',
            'post-create',
            'post-edit',
            'post-delete',
            'post-apporoval-list',
            'post-apporoval-approved',
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission, 'guard_name' => 'web']);
              Permission::create(['name' => $permission, 'guard_name' => 'api']);
         }
    }
}
