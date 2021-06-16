<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Program;
use App\Models\CourseProgram;

class CourseProgramController extends Controller
{
    //

    /**
     * Add courses to a program
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addCoursesToProgram(Request $request){

        $this->validate($request, [
            'course_id' => 'required',
            'program_id' => 'required',
            ]);
        
        $programId = $request->input('program_id');
        $courseIds = $request->input('course_id');

        $numAddedSuccessfully = 0; 

        foreach ($courseIds as $index => $courseId) {
            // create a new course program record
            $courseProgram = new CourseProgram;
            // set relationship between course and program
            $courseProgram->course_id = $courseId;
            $courseProgram->program_id = $programId;
            if ($courseProgram->save()) {
                $numAddedSuccessfully++;
                // get the current course
                $course = Course::where('course_id', $courseId)->first();
                $required = $request->input('require'.$courseId);
                $course->required = $required;
                $course->save();
            }

        }

        if ($numAddedSuccessfully == count($courseIds)) {
            $request->session()->flash('success', 'Successfully added courses to this program.');
        } else {   
            $request->session()->flash('error', "There was an error adding " . strval(count($courseIds) - $numAddedSuccessfully));
        }
        
        return redirect()->route('programWizard.step3', $request->input('program_id'));
    }

}
