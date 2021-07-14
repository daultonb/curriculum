<?php

namespace App\Http\Controllers;

use App\Models\ProgramLearningOutcome;
use App\Models\LearningOutcome;
use App\Models\Course;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutcomeMapController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $course_id = $request->input('course_id');
        // get the course
        $course =  Course::where('course_id', $course_id)->first();
        // get the learning outcome 
        $l_outcome = LearningOutcome::where('l_outcome_id', $request->input('l_outcome_id'))->first();
        // get the program learning outcomes for this program
        $programLearningOutcomes = Program::find($request->input('program_id'))->programLearningOutcomes;
        // courseToProgamOutcome is a 2-D array => map[CLO][PLO] = map_scale_value
        $courseToProgramOutcome = $request->input('map');

        foreach($programLearningOutcomes as $programLearningOutcome){
            $outcomeMap = DB::table('outcome_maps')->updateOrInsert(
                ['pl_outcome_id' =>$programLearningOutcome->pl_outcome_id , 'l_outcome_id' => $l_outcome->l_outcome_id ],
                ['map_scale_value' => $courseToProgramOutcome[$l_outcome->l_outcome_id][$programLearningOutcome->pl_outcome_id]]
            );
        }

        return redirect()->back()->with('success', 'Your answers have been saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutcomeMap  $outcomeMap
     * @return \Illuminate\Http\Response
     */
    public function show(OutcomeMap $outcomeMap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutcomeMap  $outcomeMap
     * @return \Illuminate\Http\Response
     */
    public function edit(OutcomeMap $outcomeMap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OutcomeMap  $outcomeMap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutcomeMap $outcomeMap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutcomeMap  $outcomeMap
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutcomeMap $outcomeMap)
    {
        //
    }
}
