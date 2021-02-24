<?php

namespace App\Http\Controllers;

use App\Models\AssessmentMethod;
use Illuminate\Http\Request;

class AssessmentMethodController extends Controller
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
        //

        $this->validate($request, [
            'a_method'=> 'required',
            'weight'=> 'required',
            ]);

        $weights = $request->input("weight");
        $methods =  $request->input("a_method");
        $course_id = $request->input('course_id');
        $i = 0;
        $newMethodFlag = false;

        if($method_ids = $request->input('a_method_id')) {
            $size = count($method_ids);
            $newMethodFlag = true;
        }

        $sum = 0;
        foreach($weights as $weight) {
            $sum += $weight;
            if($sum > 100) {

                return redirect()->route('courseWizard.step2', $request->input('course_id'))->with('error', 'The total weight of all assessments will exceed 100%');
            }
        }

        //store the custom assessment method


        foreach ($methods as $method) {
            if($newMethodFlag == true && $i < $size){
                $am = AssessmentMethod::where('a_method_id', $method_ids[$i])->first();
                $am->update(array('a_method' => $method,'weight'=> $weights[$i]));
                $i++;
                $request->session()->flash('success', 'Student assessment method modified');

            }else {
                $am = new AssessmentMethod;
                $am->a_method = $method;
                $am->weight = $weights[$i];
                $am->course_id = $course_id;
                $i++;
                if($am->save()){
                    $request->session()->flash('success', 'New student assessment method saved');
                }else{
                    $request->session()->flash('error', 'There was an error adding the student assessment method');
                }
            }
        }

        return redirect()->route('courseWizard.step2', $request->input('course_id'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssessmentMethod  $assessmentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(AssessmentMethod $assessmentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssessmentMethod  $assessmentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit($assessmentMethod)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssessmentMethod  $assessmentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $a_method_id)
    {
        //
        $this->validate($request, [
            'a_method'=> 'required',
            'weight'=> 'required',
            ]);

        $am = AssessmentMethod::where('a_method_id', $a_method_id)->first();

        $totalWeight = AssessmentMethod::where('course_id', $request->input('course_id'))->sum('weight');
        if($totalWeight + $request->input('weight') - $am->weight > 100){
            return redirect()->route('courseWizard.step2', $request->input('course_id'))->with('error', 'The total weight of all assessments will exceed 100%');
        }


        $am->a_method = $request->input('a_method');
        $am->weight = $request->input('weight');
        //$am->course_id = $request->input('course_id');


        if($am->save()){
            $request->session()->flash('success', 'Student assessment method updated');
        }else{
            $request->session()->flash('error', 'There was an error updating the student assessment method');
        }


        return redirect()->route('courseWizard.step2', $request->input('course_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssessmentMethod  $assessmentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $a_method_id)
    {
        $am = AssessmentMethod::where('a_method_id', $a_method_id)->first();
        $course_id = $request->input('course_id');


        if($am->delete()){
            $request->session()->flash('success','Student assessment method has been deleted');
        }else{
            $request->session()->flash('error', 'There was an error deleting the student assessment method');
        }
        return redirect()->route('courseWizard.step2', $course_id);
    }

}
