<?php

use Illuminate\Database\Seeder;

class MyclassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('myclasses')->insert([
            'id' => 1,
            'number' => 11,
            'school_id' => 1,
            'group' => 'Science',
        ]);
        DB::table('myclasses')->insert([
            'id' => 2,
            'number' => 12,
            'school_id' => 1,
            'group' => 'Science',
        ]);
    }
}
