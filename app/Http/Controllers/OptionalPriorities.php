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
        // Only a Temporary Fix as this doesn't solve the problem when a user wants to unselect PLOS.
        // when optional_PLOs == null set to empty array
        if ($optionalPLOs == !NULL) {

            // ***** Throws error when no PLO's are selected: must be of the type array, null given
            // Remove option that was not checked
            Optional_priorities::whereNotIn('custom_PLO',$optionalPLOs)->where('course_id',$course_id)->where('input_status',0)->delete();

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
            // Needs to check if PLO's had been previously saved in the db, and if so it need to delete those entries.
            $request->session()->flash('success', 'Alignment to UBC/Ministry priorities updated.');
        }

        /*
        if($inputOptionalPLOs = $request->input('inputItem')) {
            foreach($inputOptionalPLOs as $inputOptionalPLO) {
                $inputOps = Optional_priorities::where('course_id', $course_id)->get();
                $inputOptionalPLO->input_status = 1;
            }
        }
        */

        return redirect()->route('courseWizard.step5', $request->input('course_id'));
    }
}
