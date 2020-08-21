<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('email', 'admin@collection.com')->delete();

        DB::table('users')->insert([
            'first_name' => 'Nguyen',
            'last_name' => 'Admin',
            'email' => 'admin@collection.com',
            'password' => bcrypt(123456),
            'phone' => '',
            'role_id' => 1,
        ]);

        factory(App\Models\User::class, 50)->create()->each(function ($user) {
            $user->information()->save(factory(\App\Models\UserInformation::class)->make());
        });
    }
}
