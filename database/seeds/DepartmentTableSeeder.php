<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'id' => 1,
            'name' => 'Physics',
            'school_id' => 1
        ]);
        DB::table('departments')->insert([
            'id' => 2,
            'name' => 'Chemistry',
            'school_id' => 1
        ]);
        DB::table('departments')->insert([
            'id' => 3,
            'name' => 'Mathematics',
            'school_id' => 1
        ]);
    }
}
