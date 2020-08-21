<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Gái facebook',
                'description' => 'Gái facebook',
            ],
            [
                'name' => 'Gái instagram',
                'description' => 'Gái instagram',
            ],
            [
                'name' => 'Gái tuyển chọn',
                'description' => 'Gái tuyển chọn',
            ],
            [
                'name' => 'Gái nhảy baylak',
                'description' => 'Gái nhảy baylak',
            ],
            [
                'name' => 'Máy bay bà già',
                'description' => 'Máy bay bà già',
            ],
        ]);
    }
}
