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
        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Teacher1',
            'email' => 't1@test.com',
            'password' => bcrypt('teacher1'),
            'gender' => 'Male',
            'role' => 'teacher',
            'school_id' => 1,
            'department_id' => 1
        ]);
        DB::table('users')->insert([
            'id' => 4,
            'name' => 'Teacher2',
            'email' => 't2@test.com',
            'password' => bcrypt('teacher2'),
            'gender' => 'Male',
            'role' => 'teacher',
            'school_id' => 1,
            'department_id' => 2
        ]);
        DB::table('users')->insert([
            'id' => 5,
            'name' => 'Teacher3',
            'email' => 't3@test.com',
            'password' => bcrypt('teacher3'),
            'gender' => 'Male',
            'role' => 'teacher',
            'school_id' => 1,
            'department_id' => 3
        ]);

        DB::table('users')->insert([
            'id' => 6,
            'name' => 'Student1',
            'email' => 's1@test.com',
            'password' => bcrypt('student1'),
            'gender' => 'Male',
            'role' => 'student',
            'school_id' => 1,
            'birthdate' => '1999-02-11',
            'address' => 'Gandhinagar',
            'section_id' => 1
        ]);
        DB::table('users')->insert([
            'id' => 7,
            'name' => 'Student2',
            'email' => 's2@test.com',
            'password' => bcrypt('student2'),
            'gender' => 'Male',
            'role' => 'student',
            'school_id' => 1,
            'birthdate' => '1999-02-11',
            'address' => 'Gandhinagar',
            'section_id' => 1
        ]);
        DB::table('users')->insert([
            'id' => 8,
            'name' => 'Student3',
            'email' => 's3@test.com',
            'password' => bcrypt('student3'),
            'gender' => 'Male',
            'role' => 'student',
            'school_id' => 1,
            'birthdate' => '1999-02-11',
            'address' => 'Gandhinagar',
            'section_id' => 2
        ]);
        DB::table('users')->insert([
            'id' => 9,
            'name' => 'Student4',
            'email' => 's4@test.com',
            'password' => bcrypt('student4'),
            'gender' => 'Male',
            'role' => 'student',
            'school_id' => 1,
            'birthdate' => '1999-02-11',
            'address' => 'Gandhinagar',
            'section_id' => 2
        ]);
        DB::table('users')->insert([
            'id' => 10,
            'name' => 'Student5',
            'email' => 's5@test.com',
            'password' => bcrypt('student5'),
            'gender' => 'Male',
            'role' => 'student',
            'school_id' => 1,
            'birthdate' => '1999-02-11',
            'address' => 'Gandhinagar',
            'section_id' => 3
        ]);
        DB::table('users')->insert([
            'id' => 11,
            'name' => 'Student6',
            'email' => 's6@test.com',
            'password' => bcrypt('student6'),
            'gender' => 'Male',
            'role' => 'student',
            'school_id' => 1,
            'birthdate' => '1999-02-11',
            'address' => 'Gandhinagar',
            'section_id' => 3
        ]);
        DB::table('users')->insert([
            'id' => 12,
            'name' => 'Student7',
            'email' => 's7@test.com',
            'password' => bcrypt('student7'),
            'gender' => 'Male',
            'role' => 'student',
            'school_id' => 1,
            'birthdate' => '1999-02-11',
            'address' => 'Gandhinagar',
            'section_id' => 4
        ]);
        DB::table('users')->insert([
            'id' => 13,
            'name' => 'Student8',
            'email' => 's8@test.com',
            'password' => bcrypt('student8'),
            'gender' => 'Male',
            'role' => 'student',
            'school_id' => 1,
            'birthdate' => '1999-02-11',
            'address' => 'Gandhinagar',
            'section_id' => 4
        ]);
    }
}
