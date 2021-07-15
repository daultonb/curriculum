<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseProgram;
use App\Models\Program;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\CourseUser;
use App\Models\ProgramUser;
use App\Models\OutcomeMap;
use Attribute;
use Illuminate\Support\Facades\DB;

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
    public function index(Request $request)
    {

        $user = User::where('id', Auth::id())->first();

        // get courses belonging to a user
        $activeCourses = $user->courses()
        ->select('courses.course_code','courses.delivery_modality','courses.semester','courses.year','courses.section',
        'courses.course_id','courses.course_num','courses.course_title', 'courses.status')
        ->where([
            ['course_users.user_id','=',Auth::id()],
            ['courses.status', '=', 1]
        ])->orWhere([
            ['course_users.user_id','=',Auth::id()],
            ['courses.status', '=', -1]
        ])->get();

        $programs = User::join('program_users', 'users.id', '=', 'program_users.user_id')
        ->join('programs', 'program_users.program_id', "=", 'programs.program_id')
        ->select('programs.program_id','programs.program', 'programs.faculty', 'programs.level', 'programs.department', 'programs.status', 'users.email')
        ->where('program_users.user_id','=',Auth::id())
        ->get();
        // returns a collection of programs associated with courses (Programs Icon)
        $coursesPrograms = array();
        foreach ($activeCourses as $course) {
            $coursePrograms = $course->programs;
            $coursesPrograms[$course->course_id] = $coursePrograms;
        }
        
        // returns a collection of programs associated with users (Collaborators Icon) 
        $prog = $user->programs()->get();
        $programUsers = array();
        foreach ($prog as $program) {
            $programsUsers = $program->users()->get();
            $programUsers[$program->program_id] = $programsUsers;
        }
        //
        $coursesUser = $user->courses()->get();
        $courseUsers = array();
        foreach ($coursesUser as $course) {
            $coursesUsers = $course->users()->get();
            $courseUsers[$course->course_id] = $coursesUsers;
        }
        // get this users syllabi
        $syllabi = $user->syllabi;
        // get the associated users for every one of this users syllabi
        $syllabiUsers = array();
        foreach ($syllabi as $syllabus) {
            $syllabusUsers = $syllabus->users;
            $syllabiUsers[$syllabus->id] = $syllabusUsers;
        }
        // returns a collection of standard_categories, used in the create course modal
        $standard_categories = DB::table('standard_categories')->get();
        
        return view('pages.home')->with("activeCourses",$activeCourses)->with("activeProgram",$programs)->with('user', $user)->with('coursesPrograms', $coursesPrograms)->with('standard_categories', $standard_categories)->with('programUsers', $programUsers)->with('courseUsers', $courseUsers)->with('syllabi', $syllabi)->with('syllabiUsers', $syllabiUsers);
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
        $course->standard_category_id = $request->input('standard_category_id');

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
