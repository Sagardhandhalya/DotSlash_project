<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Myclass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->role == 'master') {
            return view('master');
        }
        return view('home');
    }

    public function admin()
    {
        if(Auth::user()->role == 'admin') {
            $classes = Myclass::where('school_id', Auth::user()->school->id)->get();
            foreach ($classes as $class) {
                $sections = $class->sections;
                $class->sections = $sections;
            }
            return ['classes'=> $classes];
        }
    }
}
