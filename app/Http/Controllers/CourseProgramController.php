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
        $numCoursesAddedSuccessfully = 0; 


        foreach ($courseIds as $index => $courseId) {
            $isCourseRequired = $request->input('require'.$courseId);
            // if a courseProgram with course_id and program_id exists then update course_required field else create a new courseProgram record
            CourseProgram::updateOrCreate(
                ['course_id' => $courseId, 'program_id' => $programId], 
                ['course_required' => $isCourseRequired]
            );
            $numCoursesAddedSuccessfully++;

        }

        if ($numCoursesAddedSuccessfully == count($courseIds)) {
            $request->session()->flash('success', 'Successfully added courses to this program.');
        } else {   
            $request->session()->flash('error', "There was an error adding " . strval(count($courseIds) - $numCoursesAddedSuccessfully));
        }
        
        return redirect()->route('programWizard.step3', $request->input('program_id'));
    }

}
