<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'description' => 'Admin role',
            ],
            [
                'name' => 'User Vip',
                'description' => 'User Vip',
            ],
            [
                'name' => 'User Normal',
                'description' => 'User Normal',
            ]
        ]);
    }
}
