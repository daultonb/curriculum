<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseProgram;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseUser;
use App\Models\ProgramUser;
use Attribute;

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
        /*
        $activeCourses = User::join('course_users', 'users.id', '=', 'course_users.user_id')
                ->join('courses', 'course_users.course_id', '=', 'courses.course_id')
                //->join('programs', 'courses.program_id', '=', 'programs.program_id')
                ->leftjoin('course_programs', 'courses.course_id', '=', 'course_programs.course_id')
                //->select('courses.program_id','courses.course_code','courses.delivery_modality','courses.semester','courses.year','courses.section',
                //'courses.course_id','courses.course_num','courses.course_title', 'courses.status','programs.program', 'programs.faculty', 'programs.department','programs.level')
                ->select('courses.course_code','courses.delivery_modality','courses.semester','courses.year','courses.section',
                'courses.course_id','courses.course_num','courses.course_title', 'courses.status')
                ->where([
                    ['course_users.user_id','=',Auth::id()],
                    ['courses.status', '=', 1]
                ])->orWhere([
                    ['course_users.user_id','=',Auth::id()],
                    ['courses.status', '=', -1]
                ])->get();
        */
        $activeCourses = $user->courses()->join('programs', 'courses.program_id', '=', 'programs.program_id')
        ->select('courses.program_id','courses.course_code','courses.delivery_modality','courses.semester','courses.year','courses.section',
        'courses.course_id','courses.course_num','courses.course_title', 'courses.status','programs.program', 'programs.faculty', 'programs.department','programs.level')
        ->where([
            ['course_users.user_id','=',Auth::id()],
            ['courses.status', '=', 1]
        ])->orWhere([
            ['course_users.user_id','=',Auth::id()],
            ['courses.status', '=', -1]
        ])->get();

        $programs = User::join('program_users', 'users.id', '=', 'program_users.user_id')
        ->join('programs', 'program_users.program_id', "=", 'programs.program_id')
        ->select('programs.program_id','programs.program', 'programs.faculty', 'programs.level', 'programs.department', 'programs.status')
        ->where('program_users.user_id','=',Auth::id())
        ->get();

        $coursesPrograms = array();       
        foreach ($activeCourses as $course) {
            $coursePrograms = $course->programs;
            $coursesPrograms[$course->course_id] = $coursePrograms;
        }
        
        return view('pages.home')->with("activeCourses",$activeCourses)->with("activeProgram",$programs)->with('user', $user)->with('coursePrograms', $coursePrograms)->with('coursesPrograms', $coursesPrograms);
    }


    public function getProgramUsers($program_id) {
        
        $programUsers = ProgramUser::join('users','program_users.user_id',"=","users.id")
                                ->select('users.email','program_users.user_id','program_users.program_id')
                                ->where('program_users.program_id','=',$program_id)->get();
        
        return view('pages.home')->with('ProgramUsers', $programUsers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'course_code' => 'required',
            'course_num' => 'required',
            'course_title'=> 'required',

            ]);

        $course = new Course;
        $course->program_id = $request->input('program_id');
        $course->course_title = $request->input('course_title');
        $course->course_num = $request->input('course_num');
        $course->course_code =  strtoupper($request->input('course_code'));
        $course->status = -1;
        $course->required = $request->input('required');
        $course->type = $request->input('type');

        $course->delivery_modality = $request->input('delivery_modality');
        $course->year = $request->input('course_year');
        $course->semester = $request->input('course_semester');
        $course->section = $request->input('course_section');

        if($request->input('type') == 'assigned'){

            $course->assigned = -1;

            if($course->save()){
                $request->session()->flash('success', 'New course added');
            }else{
                $request->session()->flash('error', 'There was an error adding the course');
            }

            return redirect()->route('programWizard.step3', $request->input('program_id'));

        }else{

            $course->assigned = 1;
            $course->save();

            $user = User::where('id', $request->input('user_id'))->first();
            $courseUser = new CourseUser;
            $courseUser->course_id = $course->course_id;
            $courseUser->user_id = $user->id;
            if($courseUser->save()){
                $request->session()->flash('success', 'New course added');
            }else{
                $request->session()->flash('error', 'There was an error adding the course');
            }

            return redirect()->route('home');
        }

    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $course_id)
    {
        //
        $c = Course::where('course_id', $course_id)->first();
        $type = $c->type;

        if($c->delete()){
            $request->session()->flash('success','Course has been deleted');
        }else{
            $request->session()->flash('error', 'There was an error deleting the course');
        }

        if($type == 'assigned'){
            return redirect()->route('programWizard.step3', $request->input('program_id'));
        }else{
            return redirect()->route('home');
        }

    }

    public function submit(Request $request, $course_id)
    {
        //
        $c = Course::where('course_id', $course_id)->first();
        $c->status = 1;

        if($c->save()){
            $request->session()->flash('success','Your answers have	been submitted successfully');
        }else{
            $request->session()->flash('error', 'There was an error submitting your answers');
        }

        return redirect()->route('home');
    }
}
