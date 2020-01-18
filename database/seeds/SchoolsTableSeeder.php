<?php

use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schools')->insert([
            'name' => "Bits Education HighSchool",
            'year' => 2000,
            'medium' => 'English'
        ]);
    }
}
