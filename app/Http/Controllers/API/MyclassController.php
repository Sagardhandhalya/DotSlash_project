<?php

namespace App\Http\Controllers\API;

use App\Myclass;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyclassController extends Controller
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
        $data = $this->validate($request, [
            'number' => 'required',
            'group' => 'required',
        ]);
        $data['school_id'] = Auth::user()->school->id;
        return Myclass::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Myclass  $myclass
     * @return \Illuminate\Http\Response
     */
    public function show(Myclass $myclass)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Myclass  $myclass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Myclass $myclass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Myclass  $myclass
     * @return \Illuminate\Http\Response
     */
    public function destroy(Myclass $myclass)
    {
        //
    }

    public function section($id)
    {
        $sections = Myclass::find($id)->sections;
        return ['sections' => $sections];
    }
}
