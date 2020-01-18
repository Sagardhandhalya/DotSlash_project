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

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('admin'),
            'gender' => 'Male',
            'role' => 'admin',
            'school_id' => 1
        ]);
    }
}
