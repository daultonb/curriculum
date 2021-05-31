<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Optional_priorities;

class OptionalPriorities extends Controller
{
    //
    /**
     * Store all new optional PLOs to table.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'course_id'=> 'required',
            ]);

        $course_id = $request->input('course_id');
        $optionalPLOs = $request->input('optionalItem');
        

        // Check If Any PLO's have been selected 
        if ($optionalPLOs == !NULL) {
            // Delete all OptionalPLO's not checked (Selected).
            Optional_priorities::whereNotIn('custom_PLO',$optionalPLOs)->where('course_id',$course_id)->delete();

            // Loop to insert them to the table
            foreach($optionalPLOs as $optionalPLO) {
                if(! (Optional_priorities::where('custom_PLO',$optionalPLO)->where('course_id',$course_id)->first())) {
                    $ops = new Optional_priorities();
                    $ops->course_id = $course_id;
                    $ops->custom_PLO = $optionalPLO;
                    $ops->input_status = 0;
                    if($ops->save()){
                        $request->session()->flash('success', 'Alignment to UBC/Ministry priorities updated.');
                    }else{
                        $request->session()->flash('error', 'There was an error updating the alignment to UBC/Ministry priorities.');
                    }
                }
            }
        } else {
            // Remove Any PLO's based on their course ID
            Optional_priorities::where('course_id',$course_id)->delete();
            $request->session()->flash('success', 'Alignment to UBC/Ministry priorities updated.');
        }

        return redirect()->route('courseWizard.step5', $request->input('course_id'));
    }
}
