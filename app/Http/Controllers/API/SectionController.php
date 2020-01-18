<?php

namespace App\Http\Controllers\API;

use App\Section;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Auth::user()->school->classes->pluck('id');
        $sections = Section::whereIn('class_id', $classes)->get();
        foreach ($sections as $section) {
            $class_number = $section->class->number;
            $section->class_number = $class_number;
        }
        return ['sections' => $sections];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'room' => 'required|unique:sections',
            'class_id' => 'required'
        ]);
        return Section::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        //
    }

    public function sectionCourses(Section $section)
    {
        $class = $section->class;
        $courses = $section->courses;
        return ['courses' => $courses, 'section' => $section, 'class' => $class];
    }

    public function sectionStudents(Section $section)
    {
        $students = $section->students;
        foreach ($students as $x) {
            $x->present = false;
        }
        return ['students' => $students, 'section' => $section, 'class' => $section->class];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        //
    }
}
