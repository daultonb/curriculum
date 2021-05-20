<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\Table;
use Illuminate\Support\Facades\Auth;
use App\Models\LearningOutcome;
use App\Models\AssessmentMethod;
use App\Models\Course;
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
        // get completed courses (status = 1) and in progress courses (status = -1) fir tge current user

        $allCourses = User::join('course_users', 'users.id', '=', 'course_users.user_id')
            ->join('courses', 'course_users.course_id', '=', 'courses.course_id')
            ->join('programs', 'courses.program_id', '=', 'programs.program_id')
            ->select('courses.program_id','courses.course_code','courses.delivery_modality','courses.semester','courses.year','courses.section',
            'courses.course_id','courses.course_num','courses.course_title', 'courses.status','programs.program', 'programs.faculty', 'programs.department','programs.level')
            ->where([
                ['course_users.user_id','=',Auth::id()],
                ['courses.status', '=', 1]
            ])->orWhere([
                ['course_users.user_id','=',Auth::id()],
                ['courses.status', '=', -1]
            ])->get();
            
        return view("syllabus.syllabusGenerator")->with('user', $user)->with('allCourses', $allCourses);
    }

    // Ajax to get course infomation
    public function getCourseInfo(Request $request) {

        $this->validate($request, [
            'course_id'=> 'required',
            ]);

        $course_id = $request->course_id;
        // get relevant course info for import into Syllabus Generator
        $courseInfo = Course::select('course_code', 'course_num', 'course_title', 'year', 'semester')->where('course_id', '=', $course_id)->first();
        $a_methods = AssessmentMethod::where('course_id', $course_id)->get();
        $l_outcomes = LearningOutcome::where('course_id', $course_id)->get();
        // put courseInfo, assessment methods and CLOs in the return object
        $data['c_title'] = $courseInfo->course_title;
        $data['c_code'] = $courseInfo->course_code;
        $data['c_num'] = $courseInfo->course_num;
        $data['c_year'] = $courseInfo->year;
        $data['c_term'] = $courseInfo->semester;
        $data['a_methods'] = $a_methods;
        $data['l_outcomes'] = $l_outcomes;

        $data = json_encode($data);
        return $data;
    }

    //Syllabus Word file
    public function WordExport(Request $request){
        
        // validate request
        $request->validate([
            'courseTitle' => ['required'],
            'courseCode' => ['required'],
            'courseNumber' => ['required'],
            'courseinstructor' => ['required'],
            'courseYear' => ['required'],
            'courseSemester' => ['required'],
        ]);

        $courseTitle = $request->input('courseTitle');
        $courseCode = $request->input('courseCode');
        $courseNumber = $request->input('courseNumber');
        $courseInstructor = $request->input('courseinstructor');
        $courseYear = $request->input('courseYear');
        $semester = $request->input('courseSemester');

        switch($request->input('campus')){
            // generate word syllabus for Okanagan campus course
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
                    // tell template processor to include land block
                    $templateProcessor->cloneBlock('land');
                }else{
                    // tell template processor to not include land block
                    $templateProcessor->cloneBlock('land', 0); 
                }


            break;
            case 'V':
                // generate word syllabus for Vancouver campus course
                $templateProcessor = new TemplateProcessor('word-template/UBC-V_default.docx');

                if($request->input('langAcknoledgement')){
                    // tell template processor to include land block
                    $templateProcessor->cloneBlock('land');
                }else{
                    // tell template processor to not include land block
                    $templateProcessor->cloneBlock('land', 0);
                }

                if($request->input('disabilities')){
                    $templateProcessor->cloneBlock('disabilities');
                }else{
                    $templateProcessor->cloneBlock('disabilities', 0);
                }
        
                
            break;
        }
        // add required form fields common to both campuses to template
        $templateProcessor->setValues(array('courseTitle'=> $courseTitle,'courseCode' => $courseCode, 'courseNumber'=> $courseNumber, 'courseInstructor'=> $courseInstructor,
                    'courseYear'=> $courseYear,));

        // tell template processor to include course TA if user completed the field(s)
        if($courseTa = $request->input('courseTA')){
            $templateProcessor->cloneBlock('NoTa');
            $templateProcessor->setValue('courseTA',$courseTa);
        }else{
            $templateProcessor->cloneBlock('NoTa',0);
        }
        // tell template processor to include course location if user completed the field(s)
        if ($courseLocation = $request->input('courseLocation')) {
            $templateProcessor->cloneBlock('NoCourseLocation');
            $templateProcessor->setValue('courseLocation',$courseLocation);
        } else {
            $templateProcessor->cloneBlock('NoCourseLocation',0);
        }
        
        // tell template processor to include class hours if user completed the field(s)
        if ($classStartTime = $request->input('startTime') and $classEndTime = $request->input('endTime')) {
            $templateProcessor->cloneBlock('NoClassHours');
            $templateProcessor->setValues(array('classStartTime' => $classStartTime, 'classEndTime' => $classEndTime));
        } else {
            $templateProcessor->cloneBlock('NoClassHours',0);
        }

        // tell template processor to include course schedule if user completed the field(s)
        if ($schedules = $request->input('schedule')) {
            $templateProcessor->cloneBlock('NoCourseDays');
            $schedule = "";
            foreach($schedules as $day) {
                $schedule = ($schedule == "" ? $day : $schedule . '/' . $day);
            }
            $templateProcessor->setValue('schedule',$schedule);
        } else {
            $templateProcessor->cloneBlock('NoCourseDays', 0);
        }

        // tell template processor to include office hours if user completed the field(s)
        if ($officeHour = $request->input('officeHour')) {
            $templateProcessor->cloneBlock('NoOfficeHours');
            $templateProcessor->setValue('officeHour',$officeHour);
        } else {
            $templateProcessor->cloneBlock('NoOfficeHours', 0);
        }

        // Load final dates
        if($request->input('finalcheckbox')){
            $finalDate = $request->input('finalDate');
            $templateProcessor->setValue('finalDate',$finalDate);
        }

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
                $templateProcessor->setValue('season',"Summer");
                $templateProcessor->setValue('term',"Term 1");
            break;
            case("S2"):
                $templateProcessor->setValue('season',"Summer");
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
            // tell template processor to not include 'NocourseOverview block
            $templateProcessor->cloneBlock('NocourseOverview', 0);
        }

        if($learningOutcome){
            $templateProcessor->cloneBlock('NolearningOutcomes');
            // split learning outcomes string on newline char
            $learningOutcomes = explode("\n", $learningOutcome);
            // create a table for learning outcomes (workaround for no list option)
            $learningOutcomesTable = new Table(array('borderSize'=>8, 'borderColor' => 'DCDCDC'));
            // add a new row and cell to table for each learning outcome
            foreach($learningOutcomes as $outcome) {
                $learningOutcomesTable->addRow();
                $learningOutcomesTable->addCell()->addText($outcome);
            }
            // add learning outcome table to word doc
            $templateProcessor->setComplexBlock('learningOutcomes',$learningOutcomesTable);
        }else{
            $templateProcessor->cloneBlock('NolearningOutcomes',0);
        }

        if($evaluationCriteria){
            $templateProcessor->cloneBlock('NoGrading');
            // split assessment methods string on newline char
            $assessmentMethods = explode("\n", $evaluationCriteria);
            // create a table for learning outcomes (workaround for no list option)
            $assessmentMethodsTable = new Table(array('borderSize' => 8, 'borderColor' => 'DCDCDC'));
            // add a new row and cell to table for each assessment method
            foreach($assessmentMethods as $index => $assessmentMethod){
                $assessmentMethodsTable->addRow();
                $assessmentMethodsTable->addCell()->addText(strval($index + 1));
                $assessmentMethodsTable->addCell()->addText($assessmentMethod);
            }
            // add assessment methods table to word doc
            $templateProcessor->setComplexBlock('grading', $assessmentMethodsTable);
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

        $templateProcessor->saveAs($courseCode.$courseNumber. '-Syllabus.docx');
        return response()->download($courseCode.$courseNumber.  '-Syllabus.docx')->deleteFileAfterSend(true);
    }
}
