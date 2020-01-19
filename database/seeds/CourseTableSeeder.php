<?php

use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'id' => 1,
            'name' => 'Physics',
            'class_id' => 2,
            'time' => '12:50PM-01:40PM Sunday',
            'school_id' => 1,
            'teacher_id' => 3,
            'section_id' => 1,
            'user_id' => 1,
        ]);
        DB::table('courses')->insert([
            'id' => 2,
            'name' => 'Physics',
            'class_id' => 2,
            'time' => '12:50PM-01:40PM Sunday',
            'school_id' => 1,
            'teacher_id' => 3,
            'section_id' => 2,
            'user_id' => 1,
        ]);
        DB::table('courses')->insert([
            'id' => 3,
            'name' => 'Physics',
            'class_id' => 2,
            'time' => '12:50PM-01:40PM Sunday',
            'school_id' => 1,
            'teacher_id' => 3,
            'section_id' => 3,
            'user_id' => 1,
        ]);
        DB::table('courses')->insert([
            'id' => 4,
            'name' => 'Physics',
            'class_id' => 2,
            'time' => '12:50PM-01:40PM Sunday',
            'school_id' => 1,
            'teacher_id' => 3,
            'section_id' => 4,
            'user_id' => 1,
        ]);
        DB::table('courses')->insert([
            'id' => 5,
            'name' => 'Chemistry',
            'class_id' => 2,
            'time' => '12:50PM-01:40PM Sunday',
            'school_id' => 1,
            'teacher_id' => 4,
            'section_id' => 1,
            'user_id' => 1,
        ]);
        DB::table('courses')->insert([
            'id' => 6,
            'name' => 'Chemistry',
            'class_id' => 2,
            'time' => '12:50PM-01:40PM Sunday',
            'school_id' => 1,
            'teacher_id' => 4,
            'section_id' => 2,
            'user_id' => 1,
        ]);
        DB::table('courses')->insert([
            'id' => 7,
            'name' => 'Chemistry',
            'class_id' => 2,
            'time' => '12:50PM-01:40PM Sunday',
            'school_id' => 1,
            'teacher_id' => 4,
            'section_id' => 3,
            'user_id' => 1,
        ]);
        DB::table('courses')->insert([
            'id' => 8,
            'name' => 'Chemistry',
            'class_id' => 2,
            'time' => '12:50PM-01:40PM Sunday',
            'school_id' => 1,
            'teacher_id' => 4,
            'section_id' => 4,
            'user_id' => 1,
        ]);
        DB::table('courses')->insert([
            'id' => 9,
            'name' => 'Mathematics',
            'class_id' => 2,
            'time' => '12:50PM-01:40PM Sunday',
            'school_id' => 1,
            'teacher_id' => 5,
            'section_id' => 1,
            'user_id' => 1,
        ]);
        DB::table('courses')->insert([
            'id' => 10,
            'name' => 'Mathematics',
            'class_id' => 2,
            'time' => '12:50PM-01:40PM Sunday',
            'school_id' => 1,
            'teacher_id' => 5,
            'section_id' => 2,
            'user_id' => 1,
        ]);
        DB::table('courses')->insert([
            'id' => 11,
            'name' => 'Mathematics',
            'class_id' => 2,
            'time' => '12:50PM-01:40PM Sunday',
            'school_id' => 1,
            'teacher_id' => 5,
            'section_id' => 3,
            'user_id' => 1,
        ]);
        DB::table('courses')->insert([
            'id' => 12,
            'name' => 'Mathematics',
            'class_id' => 2,
            'time' => '12:50PM-01:40PM Sunday',
            'school_id' => 1,
            'teacher_id' => 5,
            'section_id' => 4,
            'user_id' => 1,
        ]);
    }
}
