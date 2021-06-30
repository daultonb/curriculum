<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\ProgramUser;
use App\Models\CourseUser;
use App\Models\User;
use App\Models\PLOCategory;
use App\Models\ProgramLearningOutcome;
use App\Models\Course;
use App\Models\CourseProgram;
use App\Models\MappingScale;
use App\Models\LearningOutcome;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ProgramWizardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function step0($program_id)
    // {
    //     //header
    //     $faculties = array("Faculty of Arts and Social Sciences", "Faculty of Creative and Critical Studies", "Okangan School of Education", "School of Engineering", "School of Health and Exercise Sciences", "Faculty of Management", "Faculty of Science", "Faculty of Medicine", "College of Graduate Studies", "School of Nursing", "School of Social Work", "Other");
    //     $departments = array("Community, Culture and Global Studies", "Economics, Philosophy and Political Science", "History and Sociology", "Psychology", "Creative Studies", "Languages and World Literature", "English and Cultural Studies", "Biology", "Chemistry", "Computer Science, Mathematics, Physics and Statistics", "Earth, Environmental and Geographic Sciences", "Other" );
    //     $levels = array("Undergraduate", "Graduate", "Other");
    //     $program = Program::where('program_id', $program_id)->first();
    //     $user = User::where('id',Auth::id())->first();
    //     $programUsers = ProgramUser::join('users','program_users.user_id',"=","users.id")
    //                             ->select('users.email','program_users.user_id','program_users.program_id')
    //                             ->where('program_users.program_id','=',$program_id)->get();

    //     return view('programs.wizard.step1')->with('program', $program)->with("faculties", $faculties)->with("departments", $departments)->with("levels",$levels)->with('user', $user)->with('programUsers',$programUsers);
    // }

    public function step1($program_id)
    {
        //header
        $faculties = array("Faculty of Arts and Social Sciences", "Faculty of Creative and Critical Studies", "Okanagan School of Education", "School of Engineering", "School of Health and Exercise Sciences", "Faculty of Management", "Faculty of Science", "Faculty of Medicine", "College of Graduate Studies", "School of Nursing", "School of Social Work", "Other");
        $departments = array("Community, Culture and Global Studies", "Economics, Philosophy and Political Science", "History and Sociology", "Psychology", "Creative Studies", "Languages and World Literature", "English and Cultural Studies", "Biology", "Chemistry", "Computer Science, Mathematics, Physics and Statistics", "Earth, Environmental and Geographic Sciences", "Other" );
        $levels = array("Undergraduate", "Graduate", "Other");
        $user = User::where('id',Auth::id())->first();
        $programUsers = ProgramUser::join('users','program_users.user_id',"=","users.id")
                                ->select('users.email','program_users.user_id','program_users.program_id')
                                ->where('program_users.program_id','=',$program_id)->get();

        //
        $plos = ProgramLearningOutcome::where('program_id', $program_id)->get();
        $program = Program::where('program_id', $program_id)->first();
        $ploCategories = PLOCategory::where('program_id', $program_id)->get();

        //progress bar
        $ploCount = count($plos);
        $msCount = MappingScale::join('mapping_scale_programs', 'mapping_scales.map_scale_id', "=", 'mapping_scale_programs.map_scale_id')
                                    ->where('mapping_scale_programs.program_id', $program_id)->count();
        $courseCount = Course::where('program_id', $program_id)->count();



        return view('programs.wizard.step1')->with('plos', $plos)->with('program', $program)->with('ploCategories', $ploCategories)
                                            ->with("faculties", $faculties)->with("departments", $departments)->with("levels",$levels)->with('user', $user)->with('programUsers',$programUsers)
                                            ->with('ploCount',$ploCount)->with('msCount', $msCount)->with('courseCount', $courseCount);
    }

    public function step2($program_id)
    {
        //header
        $faculties = array("Faculty of Arts and Social Sciences", "Faculty of Creative and Critical Studies", "Okanagan School of Education", "School of Engineering", "School of Health and Exercise Sciences", "Faculty of Management", "Faculty of Science", "Faculty of Medicine", "College of Graduate Studies", "School of Nursing", "School of Social Work", "Other");
        $departments = array("Community, Culture and Global Studies", "Economics, Philosophy and Political Science", "History and Sociology", "Psychology", "Creative Studies", "Languages and World Literature", "English and Cultural Studies", "Biology", "Chemistry", "Computer Science, Mathematics, Physics and Statistics", "Earth, Environmental and Geographic Sciences", "Other" );
        $levels = array("Undergraduate", "Graduate", "Other");
        $user = User::where('id',Auth::id())->first();
        $programUsers = ProgramUser::join('users','program_users.user_id',"=","users.id")
                                ->select('users.email','program_users.user_id','program_users.program_id')
                                ->where('program_users.program_id','=',$program_id)->get();

        //
        $mappingScales = MappingScale::join('mapping_scale_programs', 'mapping_scales.map_scale_id', "=", 'mapping_scale_programs.map_scale_id')
                                    ->where('mapping_scale_programs.program_id', $program_id)->get();
        $program = Program::where('program_id', $program_id)->first();

        //progress bar
        $ploCount = ProgramLearningOutcome::where('program_id', $program_id)->count();;
        $msCount = count($mappingScales);
        $courseCount = Course::where('program_id', $program_id)->count();


        return view('programs.wizard.step2')->with('mappingScales', $mappingScales)->with('program', $program)
                                            ->with("faculties", $faculties)->with("departments", $departments)->with("levels",$levels)->with('user', $user)->with('programUsers',$programUsers)
                                            ->with('ploCount',$ploCount)->with('msCount', $msCount)->with('courseCount', $courseCount);
    }

    public function step3($program_id)
    {
        //header
        $faculties = array("Faculty of Arts and Social Sciences", "Faculty of Creative and Critical Studies", "Okanagan School of Education", "School of Engineering", "School of Health and Exercise Sciences", "Faculty of Management", "Faculty of Science", "Faculty of Medicine", "College of Graduate Studies", "School of Nursing", "School of Social Work", "Other");
        $departments = array("Community, Culture and Global Studies", "Economics, Philosophy and Political Science", "History and Sociology", "Psychology", "Creative Studies", "Languages and World Literature", "English and Cultural Studies", "Biology", "Chemistry", "Computer Science, Mathematics, Physics and Statistics", "Earth, Environmental and Geographic Sciences", "Other" );
        $levels = array("Undergraduate", "Graduate", "Other");
        $programUsers = ProgramUser::join('users','program_users.user_id',"=","users.id")
                                ->select('users.email','program_users.user_id','program_users.program_id')
                                ->where('program_users.program_id','=',$program_id)->get();

        // get the current user
        $user = User::where('id',Auth::id())->first();
        // get the program
        $program = Program::where('program_id', $program_id)->first();
        // get all the users that belong to this program (using relationship defined in Program model)
        //$programUsers = $program->users()->where('program_id', $program_id)->get();
        $programUsers = ProgramUser::join('users','program_users.user_id',"=","users.id")
                                ->select('users.email','program_users.user_id','program_users.program_id')
                                ->where('program_users.program_id','=',$program_id)->get();
        // get all the courses that belong to this program
        $programCourses = $program->courses()->get();
        // get ids of all the courses that belong to this program
        $programCourseIds = $programCourses->map(function ($programCourse) {
            return $programCourse->course_id;
        });

        // get all courses that belong to this user that don't yet belong to this program
        $userCoursesNotInProgram = $user->courses()->whereNotIn('courses.course_id', $programCourseIds)->get();

        $programCoursesUsers = array();
        foreach ($programCourses as $programCourse) {
            $programCoursesUsers[$programCourse->course_id] = $programCourse->users()->get();
        }

        // progress bar
        $ploCount = ProgramLearningOutcome::where('program_id', $program_id)->count();
        $msCount = MappingScale::join('mapping_scale_programs', 'mapping_scales.map_scale_id', "=", 'mapping_scale_programs.map_scale_id')
                                    ->where('mapping_scale_programs.program_id', $program_id)->count();


        return view('programs.wizard.step3')->with('program', $program)->with('programCoursesUsers', $programCoursesUsers)
                                            ->with("faculties", $faculties)->with("departments", $departments)->with("levels",$levels)->with('user', $user)->with('programUsers',$programUsers)
                                            ->with('ploCount',$ploCount)->with('msCount', $msCount)->with('programCourses', $programCourses)->with('userCoursesNotInProgram', $userCoursesNotInProgram);
    }

    public function step4($program_id)
    {
        //header
        $faculties = array("Faculty of Arts and Social Sciences", "Faculty of Creative and Critical Studies", "Okanagan School of Education", "School of Engineering", "School of Health and Exercise Sciences", "Faculty of Management", "Faculty of Science", "Faculty of Medicine", "College of Graduate Studies", "School of Nursing", "School of Social Work", "Other");
        $departments = array("Community, Culture and Global Studies", "Economics, Philosophy and Political Science", "History and Sociology", "Psychology", "Creative Studies", "Languages and World Literature", "English and Cultural Studies", "Biology", "Chemistry", "Computer Science, Mathematics, Physics and Statistics", "Earth, Environmental and Geographic Sciences", "Other" );
        $levels = array("Undergraduate", "Graduate", "Other");
        $user = User::where('id',Auth::id())->first();
        $programUsers = ProgramUser::join('users','program_users.user_id',"=","users.id")
                                ->select('users.email','program_users.user_id','program_users.program_id')
                                ->where('program_users.program_id','=',$program_id)->get();

        //
        $program = Program::where('program_id', $program_id)->first();

        //progress bar
        $ploCount = ProgramLearningOutcome::where('program_id', $program_id)->count();;
        $msCount = MappingScale::join('mapping_scale_programs', 'mapping_scales.map_scale_id', "=", 'mapping_scale_programs.map_scale_id')
                                    ->where('mapping_scale_programs.program_id', $program_id)->count();
        $courseCount = Course::where('program_id', $program_id)->count();
        
        $courses = Course::where('program_id', $program_id)->get();
        


        return view('programs.wizard.step4')->with('program', $program)
                                            ->with("faculties", $faculties)->with("departments", $departments)->with("levels",$levels)->with('user', $user)->with('programUsers',$programUsers)
                                            ->with('ploCount',$ploCount)->with('msCount', $msCount)->with('courseCount', $courseCount)->with('courses', $courses);
    }


    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
