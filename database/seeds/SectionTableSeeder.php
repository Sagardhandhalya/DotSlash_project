<?php

use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            'id' => 1,
            'name' => 'A',
            'class_id' => 1,
            'room' => '001',
        ]);
        DB::table('sections')->insert([
            'id' => 2,
            'name' => 'B',
            'class_id' => 1,
            'room' => '002',
        ]);
        DB::table('sections')->insert([
            'id' => 3,
            'name' => 'A',
            'class_id' => 2,
            'room' => '003',
        ]);
        DB::table('sections')->insert([
            'id' => 4,
            'name' => 'B',
            'class_id' => 2,
            'room' => '004',
        ]);
    }
}
