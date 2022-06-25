<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            [
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'User',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('roles')->insert($roles);
    }
}
