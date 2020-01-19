<?php

namespace App\Http\Controllers\API;

use Auth;
use App\School;
use App\Department;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchoolController extends Controller
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
        $schools = School::all();
        return ['schools' => $schools];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'year' => 'required',
            'medium' => 'required'
        ]);

        return School::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        if(Auth::user()->role == 'master') {
            $admins = $school->admins;
            return ['admins' => $admins, 'school' => $school];
        }
        else {
            return ['school' => $school];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $data = $request->validate([
            'name' => 'required',
            'year' => 'required',
            'medium' => 'required'
        ]);

        $school->update($data);
        return ['message' => 'School Updated.'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();
        return ['message', 'School Deleted'];
    }

    public function createDepartment(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
        ]);
        $data['school_id'] = Auth::user()->school->id;
        return Department::create($data);
    }

    public function getDepartments()
    {
        $departments = Auth::user()->school->departments;
        return ['departments' => $departments];
    }

    public function getTeachersByDepartment(Department $department)
    {
        $teachers = $department->teachers;
        return ['teachers' => $teachers];
    }

    public function users()
    {
        $teachers = Auth::user()->school->teachers;
        foreach ($teachers as $x) {
            $department = $x->department;
            $x->department = $department;
        }
        $students = Auth::user()->school->students;
        foreach ($students as $z) {
            $section = $z->section;
            $section->class = $z->section->class;
            $z->section = $section;
        }
        return ['teachers' => $teachers, 'students' => $students];
    }

    public function numberData(School $school)
    {
        $myclass = $school->classes;
        $teacher = $school->teachers;
        $students = $school->students;
        return ['classes' => $myclass,'teachers' => $teacher, 'students' => $students];
    }
}
