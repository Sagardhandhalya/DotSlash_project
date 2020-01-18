<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Master',
            'email' => 'master@test.com',
            'password' => bcrypt('master'),
            'gender' => 'Male',
            'role' => 'master',
            'school_id' => -1
        ]);
    }
}
