<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $course_count = \DB::table('courses')->count();
        $stadium_count = \DB::table('course_tables')->count();
        $total_bespoke = \DB::table('user_bespoke')->count();

        return view('home',compact('course_count','stadium_count','total_bespoke'));
    }
}
