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
        // get completed courses (status = 1) and in progress courses (status = -1) for the current user
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

        $inputFieldDescriptions['otherCourseStaff'] = "If others lead face-to-face components such as tutorials or labs, let students know that they will meet them and be introduced in those sessions. Are others involved in marking homework? If so, do you want to identify them and provide contact information to students or have inquiries come to you?";

        $inputFieldDescriptions['learningOutcomes'] = 'Tell students what changes in their knowledge, skills, or attitudes should occur during the course. Knowing these, students will have a framework within which to put individual components of the course and they will be primed for the kinds of assessments of learning that will come.';

        $inputFieldDescriptions['learningAssessments'] = 'Identify the various ways you will assess achievement of stated learning outcomes or objectives, when each will occur, and the weighting of each component in the final grade. 
        Sometimes your assessment plan will need to be adjusted, you must discuss the proposal with the class and provide a rationale and then update the syllabus. A new, dated electronic syllabus must be provided';

        $inputFieldDescriptions['learningActivities'] = 'Do you expect students to participate in class? In what ways? (e.g., case studies, using “clickers” to answer questions, working in small groups, etc.) Is participation in on-line discussions required? Are readings required in advance with answers to be submitted to discussion questions or problem sets? 
        Is an oral presentation required? Is there a field excursion?
        ';

        $inputFieldDescriptions['learningMaterials'] = 'List of required learning materials for your course and where they might be obtained (e.g. the Bookstore if you ordered a text or a reading package, your department office if an in-house resource is available).
        Providing students with at least an estimate of the costs of materials is expected. 
        Explanation of any on-line learning management system used (e.g.Canvas).
        ';

        $inputFieldDescriptions['latePolicy'] = 'State your policies on re-grading of marked work and on late submissions. What are the penalties for late assignments?';

        $inputFieldDescriptions['missedActivityPolicy'] = 'In accordance with policy on Grading Practices, state how you deal with missed in-class assessments (e.g., are make-up tests offered for missed in-class tests, do you count the best X of Y assignments/tests, do you re-weight the marks from a missed test onto later assessments?';

        $inputFieldDescriptions['courseDescription'] = "As in the Academic Calendar or, for courses without a published description, include a brief representative one";

        $inputFieldDescriptions['coursePrereqs'] = 'Is there a course that students must have passed before taking this course?';

        $inputFieldDescriptions['courseCoreqs'] = 'Is there a course that students must take concurrently (if not before)?';

        $inputFieldDescriptions['courseContacts'] = 'Include any and all contact information you are willing to have students use. If you have a preferred mode, state it. For example, do you accept email inquiries? What is your typical response time?';

        $inputFieldDescriptions['officeHours'] = 'Do you have set office hours or can students make appointments? Do you hold “office hours” online? If so, how do students access you?';

        $inputFieldDescriptions['courseStructure'] = 'First, the basic components: lecture, lab, discussion, tutorial. Typically the locations are on the Student Service Centre but you may wish to include them.
        Then a description of how your classes are structured: Do you use traditional lecturing? Do you provide notes (outlines)? Do you combine on-line and in-class activity?
        You may wish to combine this section and Learning Outcomes below to provide an opportunity to introduce students to your philosophy of learning, to the culture of your discipline and how this course fits in the larger context.
        ';

        $inputFieldDescriptions['courseSchedule'] = 'This may be a weekly schedule, it may be class by class, but let students know that if changes occur, they will be informed.';

        $inputFieldDescriptions['instructorBioStatement'] = 'You may wish to include your department/faculty/school and other information about your academic qualifications, interests, etc.';
            
        return view("syllabus.syllabusGenerator")->with('user', $user)->with('allCourses', $allCourses)->with('inputFieldDescriptions', $inputFieldDescriptions);
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
            'campus' => ['required'],
            'courseTitle' => ['required'],
            'courseCode' => ['required'],
            'courseNumber' => ['required'],
            'courseinstructor' => ['required'],
            'courseYear' => ['required'],
            'courseSemester' => ['required'],
        ]);
        $campus = $request->input('campus');
        $courseTitle = $request->input('courseTitle');
        $courseCode = $request->input('courseCode');
        $courseNumber = $request->input('courseNumber');
        $courseInstructor = $request->input('courseinstructor');
        $courseYear = $request->input('courseYear');
        $semester = $request->input('courseSemester');

        switch($campus){
            // generate word syllabus for Okanagan campus course
            case 'O':
                $templateProcessor = new TemplateProcessor('word-template/UBC-O_default.docx');

                if($courseFormat = $request->input('courseFormat')){
                    $templateProcessor->cloneBlock('NocourseFormat');
                    $templateProcessor->setValue('courseFormat',$courseFormat);
                }else{
                    $templateProcessor->cloneBlock('NocourseFormat',0);
                }
        
                if($courseOverview = $request->input('courseOverview')){
                    $templateProcessor->cloneBlock('NocourseOverview');
                    $templateProcessor->setValue('courseOverview',$courseOverview);
                }else{
                    // tell template processor to not include 'NocourseOverview block
                    $templateProcessor->cloneBlock('NocourseOverview', 0);
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
                } else {
                    $templateProcessor->cloneBlock('final_exam', 0);
                }

            break;
            case 'V':
                $request->validate([
                    'courseCredit' => ['required'],
                ]);
                $courseCredit = $request->input('courseCredit');
                // generate word syllabus for Vancouver campus course
                $templateProcessor = new TemplateProcessor('word-template/UBC-V_default.docx');

                // add required form fields specific to Vancouver campus to template
                $templateProcessor->setValues(array('courseCredit' => $courseCredit,));

                if($officeLocation = $request->input('officeLocation')){
                    $templateProcessor->cloneBlock('NoOfficeLocation');
                    $templateProcessor->setValue('officeLocation', $officeLocation);
                }else{
                    $templateProcessor->cloneBlock('NoOfficeLocation', 0);
                }

                // include vancouver course description in template
                if($courseDescription = $request->input('courseDescription')){
                    $templateProcessor->cloneBlock('NoCourseDescription');
                    $templateProcessor->setValue('courseDescription', $courseDescription);
                }else{
                    $templateProcessor->cloneBlock('NoCourseDescription', 0);
                }

                if($contacts = $request->input('courseContacts')){
                    $templateProcessor->cloneBlock('NoContacts');
                    // split contacts string on newline char
                    $contactsArr = explode("\n", $contacts);
                    // create a table for contacts (workaround for no list option)
                    $contactsTable = new Table(array('borderSize' => 8, 'borderColor' => 'DCDCDC'));
                    // add a new row and cell to table for each contact
                    foreach($contactsArr as $index => $contact){
                        $contactsTable->addRow();
                        $contactsTable->addCell()->addText(strval($index + 1));
                        $contactsTable->addCell()->addText($contact);
                    }
                    // add contacts table to word doc
                    $templateProcessor->setComplexBlock('contacts', $contactsTable);
                    
                }else{
                    $templateProcessor->cloneBlock('NoContacts', 0);
                }

                if($coursePrereqs = $request->input('coursePrereqs')){
                    $templateProcessor->cloneBlock('NoPrerequisites');
                    // split course prereqs string on newline char
                    $coursePrereqsArr = explode("\n", $coursePrereqs);
                    // create a table for course prereqs (workaround for no list option)
                    $coursePrereqsTable = new Table(array('borderSize' => 8, 'borderColor' => 'DCDCDC'));
                    // add a new row and cell to table for each prereq
                    foreach($coursePrereqsArr as $index => $prereq){
                        $coursePrereqsTable->addRow();
                        $coursePrereqsTable->addCell()->addText(strval($index + 1));
                        $coursePrereqsTable->addCell()->addText($prereq);
                    }
                    // add course prereqs table to word doc
                    $templateProcessor->setComplexBlock('prerequisites', $coursePrereqsTable);
                }else{
                    $templateProcessor->cloneBlock('NoPrerequisites', 0);
                }

                if($courseCoreqs = $request->input('courseCoreqs')){
                    $templateProcessor->cloneBlock('NoCorequisites');
                    // split course coreqs string on newline char
                    $courseCoreqsArr = explode("\n", $courseCoreqs);
                    // create a table for course coreqs (workaround for no list option)
                    $courseCoreqsTable = new Table(array('borderSize' => 8, 'borderColor' => 'DCDCDC'));
                    // add a new row and cell to table for each coreq
                    foreach($courseCoreqsArr as $index => $coreq){
                        $courseCoreqsTable->addRow();
                        $courseCoreqsTable->addCell()->addText(strval($index + 1));
                        $courseCoreqsTable->addCell()->addText($coreq);
                    }
                    // add course coreqs table to word doc
                    $templateProcessor->setComplexBlock('corequisites', $courseCoreqsTable);
                }else{
                    $templateProcessor->cloneBlock('NoCorequisites', 0);
                }

                if($courseInstructorBio = $request->input('courseInstructorBio')){
                    $templateProcessor->cloneBlock('NoInstructorBio');
                    $templateProcessor->setValue('instructorBio', $courseInstructorBio);
                }else{
                    $templateProcessor->cloneBlock('NoInstructorBio', 0);
                }

                if($courseStructure = $request->input('courseStructure')){
                    $templateProcessor->cloneBlock('NoCourseStructure');
                    $templateProcessor->setValue('courseStructure', $courseStructure);
                }else{
                    $templateProcessor->cloneBlock('NoCourseStructure', 0);
                }

                if($courseSchedule = $request->input('courseSchedule')){
                    $templateProcessor->cloneBlock('NoTopicsSchedule');
                    $templateProcessor->setValue('courseSchedule', $courseSchedule);
                }else{
                    $templateProcessor->cloneBlock('NoTopicsSchedule', 0);
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

        // date the syllabus
        $templateProcessor->setValue('dateGenerated', date('d, M Y'));

        // tell template processor to include a land acknowledgement if user selected it
        if($request->input('landAcknowledgement')){
            $templateProcessor->cloneBlock('land');
        }else{
            $templateProcessor->cloneBlock('land', 0);
        }

        // tell template processor to include learning activities if user completed the field(s)
        if($learningActivities = $request->input('learningActivities')){
            $templateProcessor->cloneBlock('NoLearningActivities');
            // split learning activities string on newline char
            $learningActivitiesArr = explode("\n", $learningActivities);
            // create a table for learning activities (workaround for no list option)
            $learningActivitiesTable = new Table(array('borderSize' => 8, 'borderColor' => 'DCDCDC'));
            // add a new row and cell to table for each learning activity
            foreach($learningActivitiesArr as $index => $learningActivity){
                $learningActivitiesTable->addRow();
                $learningActivitiesTable->addCell()->addText(strval($index + 1));
                $learningActivitiesTable->addCell()->addText($learningActivity);
            }
            // add learning activities table to word doc
            $templateProcessor->setComplexBlock('learningActivities', $learningActivitiesTable);
        }else{
            $templateProcessor->cloneBlock('NoLearningActivities',0);
        }
        // tell template processor to include other course staff if user completed the field(s)
        if($otherCourseStaff = $request->input('otherCourseStaff')){
            $templateProcessor->cloneBlock('NoOtherInstructionalStaff');
            // split other course staff string on newline char
            $otherCourseStaffArr = explode("\n", $otherCourseStaff);
            // create a table for other course staff (workaround for no list option)
            $otherCourseStaffTable = new Table(array('borderSize' => 8, 'borderColor' => 'DCDCDC'));
            // add a new row and cell to table for each course staff member
            foreach($otherCourseStaffArr as $index => $courseStaffMember){
                $otherCourseStaffTable->addRow();
                $otherCourseStaffTable->addCell()->addText(strval($index + 1));
                $otherCourseStaffTable->addCell()->addText($courseStaffMember);
            }
            // add other course staff table to word doc
            $templateProcessor->setComplexBlock('otherInstructionalStaff', $otherCourseStaffTable);
        }else{
            $templateProcessor->cloneBlock('NoOtherInstructionalStaff',0);
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

        if($learningOutcome = $request->input('learningOutcome')){
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

        if($learningAssessments = $request->input('learningAssessments')){
            $templateProcessor->cloneBlock('NoLearningAssessments');
            // split assessment methods string on newline char
            $assessmentMethods = explode("\n", $learningAssessments);
            // create a table for learning outcomes (workaround for no list option)
            $assessmentMethodsTable = new Table(array('borderSize' => 8, 'borderColor' => 'DCDCDC'));
            // add a new row and cell to table for each assessment method
            foreach($assessmentMethods as $index => $assessmentMethod){
                $assessmentMethodsTable->addRow();
                $assessmentMethodsTable->addCell()->addText(strval($index + 1));
                $assessmentMethodsTable->addCell()->addText($assessmentMethod);
            }
            // add assessment methods table to word doc
            $templateProcessor->setComplexBlock('learningAssessments', $assessmentMethodsTable);
        }else{
            $templateProcessor->cloneBlock('NoLearningAssessments',0);
        }

        if($latePolicy = $request->input('latePolicy')){
            $templateProcessor->cloneBlock('NolatePolicy');
            $templateProcessor->setValue('latePolicy',$latePolicy);
        }else{
            $templateProcessor->cloneBlock('NolatePolicy',0);
        }

        if($missingExam = $request->input('missingExam')){
            $templateProcessor->cloneBlock('NoMissingExam');
            $templateProcessor->setValue('missingExam',$missingExam);
        }else{
            $templateProcessor->cloneBlock('NoMissingExam',0);
        }

        if($missingActivity = $request->input('missingActivity')){
            $templateProcessor->cloneBlock('NomissingActivity');
            $templateProcessor->setValue('missingActivity',$missingActivity);
        }else{
            $templateProcessor->cloneBlock('NomissingActivity',0);
        }

        if($passingCriteria = $request->input('passingCriteria')){
            $templateProcessor->cloneBlock('NopassingCriteria');
            $templateProcessor->setValue('passingCriteria',$passingCriteria);
        }else{
            $templateProcessor->cloneBlock('NopassingCriteria',0);
        }

        if($learningMaterials = $request->input('learningMaterials')){
            $templateProcessor->cloneBlock('NoLearningMaterials');
            $templateProcessor->setValue('learningMaterials',$learningMaterials);
        }else{
            $templateProcessor->cloneBlock('NoLearningMaterials',0);
        }

        if($request->input('academic')){
            $templateProcessor->cloneBlock('academic');
        }else{
            $templateProcessor->cloneBlock('academic', 0);
        }

        $templateProcessor->saveAs($courseCode.$courseNumber. '-Syllabus.docx');
        return response()->download($courseCode.$courseNumber.  '-Syllabus.docx')->deleteFileAfterSend(true);
    }

}
