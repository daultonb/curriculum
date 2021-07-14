<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseMapController extends Controller
{
    public function index($course_id, $program_id) {
        $program = Program::where('program_id', $program_id)->first();
        $course = Course::where('course_id', $course_id)->first();
        
        return view('courses.map')->with('course', $course)->with('program', $program);
    }
}
