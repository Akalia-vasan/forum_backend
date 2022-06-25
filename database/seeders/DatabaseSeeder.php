<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
