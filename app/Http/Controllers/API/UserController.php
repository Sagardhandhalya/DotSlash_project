<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->role == 'master') {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'role' => 'required',
                'gender' => 'required',
                'school_id' => 'required'
            ]);
            $data['password'] = Hash::make($data['password']);
            return User::create($data);
        }
        if(Auth::user()->role == 'admin') {
            if($request->role == 'teacher') {
                $data = $request->validate([
                    'name' => 'required',
                    'email' => 'required',
                    'role' => 'required',
                    'gender' => 'required',
                    'department_id' => 'required',
                    'password' => 'required'
                ]);
                $data['school_id'] = Auth::user()->school->id;
                $data['password'] = Hash::make($data['password']);
                return User::create($data);
            } 
            if($request->role == 'student') {
                $data = $request->validate([
                    'name' => 'required',
                    'father_name' => 'required',
                    'birthdate' => 'required',
                    'address' => 'required',
                    'section_id' => 'required',
                    'email' => 'required',
                    'role' => 'required',
                    'gender' => 'required',
                    'school_id' => 'required'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'gender' => 'required',
            'school_id' => 'required'
        ]);
        $data['password'] = $user->password;
        $user->update($data);
        return ['message' => 'User Updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function teacherCourses(User $user)
    {
        $courses = $user->courses;
        foreach ($courses as $x) {
            $section = $x->section;
            $x->section = $section;
            $x->class = $section->class->number;
        }
        return ['courses' => $courses];
    }

    public function studentCourses()
    {
        $courses = Auth::user()->section->courses;
        foreach ($courses as $x) {
            $teacher = $x->teacher;
            $x->teacher = $teacher;
        }
        $section = Auth::user()->section;
        return ['courses' => $courses, 'section' => $section, 'class' => $section->class];
    }
    
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'newpassword' => 'required',
        ]);
        $user = Auth::user();
        $user->password = Hash::make($request->newpassword);
        $user->save();
        return view('home');
    }
}
