<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::where('id', Auth::id())->first();

        $activeCourses = User::join('course_users', 'users.id', '=', 'course_users.user_id')
                ->join('courses', 'course_users.course_id', '=', 'courses.course_id')
                ->join('programs', 'courses.program_id', '=', 'programs.program_id')
                ->select('courses.program_id','courses.course_code','courses.delivery_modality','courses.semester','courses.year','courses.section',
                'courses.course_id','courses.course_num','courses.course_title', 'courses.status','programs.program', 'programs.faculty', 'programs.department','programs.level')
                ->where('course_users.user_id','=',Auth::id())->where('courses.status','=', -1)
                ->get();

        $programs = User::join('program_users', 'users.id', '=', 'program_users.user_id')
        ->join('programs', 'program_users.program_id', "=", 'programs.program_id')
        ->select('programs.program_id','programs.program', 'programs.faculty', 'programs.level', 'programs.department', 'programs.status')
        ->where('program_users.user_id','=',Auth::id())
        ->get();

        /*
        $courseUsers = array();
        foreach($activeCourses as $course){
            $courseUsers[] =
            Course::join('course_users','courses.course_id',"=","course_users.course_id")
            ->join('users','course_users.user_id',"=","users.id")
            ->select('users.email')
            ->where('courses.course_id','=',$course->course_id)->get();
        }
        */

        return view('pages.home')->with("activeCourses",$activeCourses)->with("activeProgram",$programs);
    }
}
