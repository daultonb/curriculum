<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;


class SyllabusController extends Controller
{
    //
    public function index(){
        return view("syllabus.syllabusGenerator");
    }

    public function WordExport(Request $request){

        $courseTitle = $request->input('courseTitle');
        $courseNumber = $request->input('courseNumber');
        $courseInstructor = $request->input('courseinstructor');
        $courseTA = $request->input('courseTA');
        $courseLocation = $request->input('courseLocation');
        $courseStartTime = $request->input('startTime');
        $courseEndTime = $request->input('endTime');
        $courseStartDay = $request->input('semesterStartday');
        $courseEndDay = $request->input('semesterEndday');
        $courseYear = $request->input('courseYear');
        $schedule = $request->input('schedule[]');

        if($request->input('finalcheckbox')){
            $finalDate = $request->input('finalDate');
        }

        $templateProcessor = new TemplateProcessor('word-template/user.docx');
        $templateProcessor->setValue('courseTitle',$courseTitle);
        $templateProcessor->setValue('courseNumber',$courseNumber);
        $templateProcessor->setValue('courseInstructor',$courseInstructor);
        $templateProcessor->setValue('courseTA',$courseTA);
        $templateProcessor->setValue('courseLocation',$courseLocation);
        $templateProcessor->setValue('courseStartTime',$courseStartTime);
        $templateProcessor->setValue('courseEndTime',$courseEndTime);
        $templateProcessor->setValue('courseStartDay',$courseStartDay);
        $templateProcessor->setValue('courseEndDay',$courseEndDay);
        $templateProcessor->setValue('courseYear',$courseYear);
        $templateProcessor->setValue('finalDate',$finalDate);
        $templateProcessor->setValue('schedule',$schedule);

        $templateProcessor->saveAs('Syllabus.docx');
        return response()->download('Syllabus.docx')->deleteFileAfterSend(true);
    }
}
