<?php

namespace App\Http\Controllers;

use App\Models\ProgramLearningOutcome;
use App\Models\LearningOutcome;
use App\Models\Course;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StandardsOutcomeMapController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
       //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        // get the learning outcome 
        $l_outcome = LearningOutcome::where('l_outcome_id', $request->input('l_outcome_id'))->first();
        // get the standard priorities and outcomes
        $courseStandardOutcomes = Course::find($request->input('standard_category_id'))->courseStandardOutcomes;
        // get the program learning outcomes for this program
        //$programLearningOutcomes = Program::find($request->input('program_id'))->programLearningOutcomes;
        // courseToProgramOutcome is a 2-D array => map[CLO][standard] = map_scale_value
        $courseToProgramOutcome = $request->input('map');

        foreach($courseStandardOutcomes as $courseStandardOutcome){
            $outcomeMap = DB::table('standards_outcome_maps')->updateOrInsert(
            ['standard_id' =>$courseStandardOutcome->standard_id , 'l_outcome_id' => $l_outcome->l_outcome_id ],
            ['map_scale_value' => $courseToProgramOutcome[$l_outcome->l_outcome_id][$courseStandardOutcome->standard_id]]
            );
        }

        return redirect()->back()->with('success', 'Your answers have been saved successfully.');
    }
}
