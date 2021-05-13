<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Auth;
use App\Models\LearningOutcome;
use App\Models\AssessmentMethod;
use PhpOffice\PhpWord\Element\TextRun;

class SyllabusController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(){
        $user = User::where('id', Auth::id())->first();

        $activeCourses = User::join('course_users', 'users.id', '=', 'course_users.user_id')
                ->join('courses', 'course_users.course_id', '=', 'courses.course_id')
                ->join('programs', 'courses.program_id', '=', 'programs.program_id')
                ->select('courses.program_id','courses.course_code','courses.delivery_modality','courses.semester','courses.year','courses.section',
                'courses.course_id','courses.course_num','courses.course_title', 'courses.status','programs.program', 'programs.faculty', 'programs.department','programs.level')
                ->where('course_users.user_id','=',Auth::id())->where('courses.status','=', -1)
                ->get();

        $archivedCourses = User::join('course_users', 'users.id', '=', 'course_users.user_id')
                ->join('courses', 'course_users.course_id', '=', 'courses.course_id')
                ->join('programs', 'courses.program_id', '=', 'programs.program_id')
                ->select('courses.program_id','courses.course_code','courses.delivery_modality','courses.semester','courses.year','courses.section',
                'courses.course_id','courses.course_num','courses.course_title', 'courses.status','programs.program', 'programs.faculty', 'programs.department','programs.level')
                ->where('course_users.user_id','=',Auth::id())->where('courses.status','=', 1)
                ->get();

        return view("syllabus.syllabusGenerator")->with('user', $user)->with('activeCourses', $activeCourses)->with('archivedCourses', $archivedCourses);
    }

    //Ajax to get course infomatio
    public function getCourseInfo(Request $request) {

        $this->validate($request, [
            'course_id'=> 'required',
            ]);

        $course_id = $request->course_id;

        $a_methods = AssessmentMethod::where('course_id', $course_id)->get();
        $l_outcomes = LearningOutcome::where('course_id', $course_id)->get();
        $data['a_methods'] = $a_methods;
        $data['l_outcomes'] = $l_outcomes;

        $data = json_encode($data);
        return $data;
    }

    //Syllabus Word file
    public function WordExport(Request $request){
        $courseTitle = $request->input('courseTitle');
        $courseNumber = $request->input('courseNumber');
        $courseInstructor = $request->input('courseinstructor');
        $courseTa = $request->input('courseTA');
        $courseLocation = $request->input('courseLocation');
        $courseStartTime = $request->input('startTime');
        $courseEndTime = $request->input('endTime');
        $courseStartDay = $request->input('semesterStartday');
        $courseEndDay = $request->input('semesterEndday');
        $courseYear = $request->input('courseYear');
        $schedules = $request->input('schedule');
        $semester = $request->input('courseSemester');
        $office_hour = $request->input('officeHour');

        switch($request->input('campus')){
            case 'O':
                $templateProcessor = new TemplateProcessor('word-template/UBC-O_default.docx');

                if($request->input('academic')){
                    $templateProcessor->cloneBlock('academic');
                }else{
                    $templateProcessor->cloneBlock('academic', 0);
                }

                if($request->input('gradingPractices')){
                    $templateProcessor->cloneBlock('grading_practice');
                }else{
                    $templateProcessor->cloneBlock('grading_practice', 0);
                }

                if($request->input('health')){
                    $templateProcessor->cloneBlock('health');
                }else{
                    $templateProcessor->cloneBlock('health', 0);
                }

                if($request->input('hub')){
                    $templateProcessor->cloneBlock('hub');
                }else{
                    $templateProcessor->cloneBlock('hub', 0);
                }

                if($request->input('equity')){
                    $templateProcessor->cloneBlock('equity');
                }else{
                    $templateProcessor->cloneBlock('equity', 0);
                }

                if($request->input('disabilityAssistance')){
                    $templateProcessor->cloneBlock('disability');
                }else{
                    $templateProcessor->cloneBlock('disability', 0);
                }

                if($request->input('safewalk')){
                    $templateProcessor->cloneBlock('safewalk');
                }else{
                    $templateProcessor->cloneBlock('safewalk', 0);
                }

                if($request->input('final')){
                    $templateProcessor->cloneBlock('final_exam');
                }else{
                    $templateProcessor->cloneBlock('final_exam', 0);
                }

                if($request->input('langAcknoledgement')){
                    $land = "The UBC Okanagan campus is situated on the territory of the Syilx Okanagan Nation.";
                    $templateProcessor->setValue('land', $land);
                }else{
                    $templateProcessor->setValue('land', ""); //insert blank instead of "${land}"
                }


            break;
            case 'V':
                $templateProcessor = new TemplateProcessor('word-template/UBC-V_default.docx');

                if($request->input('langAcknoledgement')){
                    $land = "We acknowledge that the UBC Point Grey campus is situated on the traditional, ancestral and unceded territory of the Musqueam people.";
                    $templateProcessor->setValue('land',$land);
                }else{
                    $templateProcessor->cloneBlock('land',0);
                }
            break;
        }

        $templateProcessor->setValues(array('courseTitle'=> $courseTitle,'courseNumber'=> $courseNumber, 'courseInstructor'=> $courseInstructor,
                    'courseLocation'=> $courseLocation, 'courseStartTime'=> $courseStartTime, 'courseEndTime'=> $courseEndTime, 'courseStartDay'=>$courseStartDay,
                    'courseEndDay'=> $courseEndDay,'courseYear'=> $courseYear,'office_hour' => $office_hour));




        // Load final dates
        if($request->input('finalcheckbox')){
            $finalDate = $request->input('finalDate');
            $templateProcessor->setValue('finalDate',$finalDate);
        }


        if($courseTa = $request->input('courseTA')){
            $templateProcessor->cloneBlock('NoTa');
            $templateProcessor->setValue('courseTA',$courseTa);
        }else{
            $templateProcessor->cloneBlock('NoTa',0);
        }

        $schedule = "";
        foreach($schedules as $day) {
            $schedule = ($schedule == "" ? $day : $schedule . '/' . $day);
        }
        $templateProcessor->setValue('schedule',$schedule);

        switch($semester){
            case("W1"):
                $templateProcessor->setValue('season',"Winter");
                $templateProcessor->setValue('term',"Term 1");
            break;
            case("W2"):
                $templateProcessor->setValue('season',"Winter");
                $templateProcessor->setValue('term',"Term 2");
            break;
            case("S1"):
                $templateProcessor->setValue('season',"Summar");
                $templateProcessor->setValue('term',"Term 1");
            break;
            case("S2"):
                $templateProcessor->setValue('season',"Summar");
                $templateProcessor->setValue('term',"Term 2");
            break;
        }

        //UBC logo
        $templateProcessor->setImageValue('UBC_logo', array('path' => 'img/UBC-logo-2018-fullsig-blue-rgb72.png', 'width' => 400, 'height' => 400, 'ratio' => true));

        $courseFormat = $request->input('courseFormat');
        $courseOverview = $request->input('courseOverview');
        $learningOutcome = $request->input('learningOutcome');
        $evaluationCriteria = $request->input('evaluationCriteria');
        $latePolicy = $request->input('latePolicy');
        $missingExam = $request->input('missingExam');
        $missingActivity = $request->input('missingActivity');
        $passingCriteria = $request->input('passingCriteria');
        $requiredReading = $request->input('requiredReading');

        if($courseFormat){
            $templateProcessor->cloneBlock('NocourseFormat');
            $templateProcessor->setValue('courseFormat',$courseFormat);
        }else{
            $templateProcessor->cloneBlock('NocourseFormat',0);
        }

        if($courseOverview){
            $templateProcessor->cloneBlock('NocourseOverview');
            $templateProcessor->setValue('courseOverview',$courseOverview);
        }else{
            $templateProcessor->cloneBlock('NocourseOverview',0);
        }

        if($learningOutcome){
            $templateProcessor->cloneBlock('NolearningOutcomes');
            $templateProcessor->setValue('learningOutcomes',$learningOutcome);
        }else{
            $templateProcessor->cloneBlock('NolearningOutcomes',0);
        }

        if($evaluationCriteria){
            $templateProcessor->cloneBlock('NoGrading');
            $templateProcessor->setValue('grading',$evaluationCriteria);
        }else{
            $templateProcessor->cloneBlock('NoGrading',0);
        }

        if($latePolicy){
            $templateProcessor->cloneBlock('NolatePolicy');
            $templateProcessor->setValue('latePolicy',$latePolicy);
        }else{
            $templateProcessor->cloneBlock('NolatePolicy',0);
        }

        if($missingExam){
            $templateProcessor->cloneBlock('NoMissingExam');
            $templateProcessor->setValue('missingExam',$missingExam);
        }else{
            $templateProcessor->cloneBlock('NoMissingExam',0);
        }

        if($missingActivity){
            $templateProcessor->cloneBlock('NomissingActivity');
            $templateProcessor->setValue('missingActivity',$missingActivity);
        }else{
            $templateProcessor->cloneBlock('NomissingActivity',0);
        }

        if($passingCriteria){
            $templateProcessor->cloneBlock('NopassingCriteria');
            $templateProcessor->setValue('passingCriteria',$passingCriteria);
        }else{
            $templateProcessor->cloneBlock('NopassingCriteria',0);
        }

        if($requiredReading){
            $templateProcessor->cloneBlock('Norequire_reading');
            $templateProcessor->setValue('require_reading',$requiredReading);
        }else{
            $templateProcessor->cloneBlock('Norequire_reading',0);
        }


        $templateProcessor->saveAs($courseNumber . '-Syllabus.docx');
        return response()->download($courseNumber .  '-Syllabus.docx')->deleteFileAfterSend(true);
    }
}
