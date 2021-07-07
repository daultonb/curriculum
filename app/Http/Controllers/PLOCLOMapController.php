<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Course;
use App\Models\MappingScale;
use App\Models\LearningOutcome;
use App\Models\ProgramLearningOutcome;
use Illuminate\Http\Request;

class PLOCLOMapController extends Controller
{
    public function index($course_id, $program_id) {
        $program = Program::where('program_id', $program_id)->first();
        $course = Course::where('course_id', $course_id)->first();

        $mappingScales = MappingScale::join('mapping_scale_programs', 'mapping_scales.map_scale_id', "=", 'mapping_scale_programs.map_scale_id')
                            ->where('mapping_scale_programs.program_id', $program_id)->get();
        $l_outcomes = LearningOutcome::where('course_id', $course_id)->get();
        
        $pl_outcomes = ProgramLearningOutcome::where('program_id', $course->program_id)->get();
        //$pl_outcomes = ProgramLearningOutcome::where('program_id', $program_id)->get();
        
        
        return view('courses.ploclomap')->with('course', $course)->with('program', $program)->with('mappingScales', $mappingScales)->with('l_outcomes',$l_outcomes)->with('pl_outcomes',$pl_outcomes);
    }
}
