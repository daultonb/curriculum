<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CourseOptionalPriorities;

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
            // Get op_id's from optionalPLOs
            $optionalPLOs_op_ids = DB::table('optional_priorities')->whereIn('optional_priority',$optionalPLOs)->pluck('op_id');

            // Delete all OptionalPLO's not checked (Selected).
            DB::table('course_optional_priorities')->whereNotIn('op_id',$optionalPLOs_op_ids)->where('course_id',$course_id)->delete();
          
            // Loop to insert them to the table
            foreach($optionalPLOs_op_ids as $optionalPLO_op_id) {
                if(! (DB::table('course_optional_priorities')->where('op_id',$optionalPLO_op_id)->where('course_id',$course_id)->first())) {
                    $ops = CourseOptionalPriorities::create([
                        'op_id' => $optionalPLO_op_id,
                        'course_id' => $course_id,
                        'created_at' => null,
                        'updated_at' => null,
                    ]);
                    if($ops->save()){
                        $request->session()->flash('success', 'Alignment to UBC/Ministry priorities updated.');
                    }else{
                        $request->session()->flash('error', 'There was an error updating the alignment to UBC/Ministry priorities.');
                    }
                }
            }
        } else {
            // Remove Any PLO's based on their course ID
            DB::table('course_optional_priorities')->where('course_id',$course_id)->delete();
            $request->session()->flash('success', 'Alignment to UBC/Ministry priorities updated.');
        }

        return redirect()->route('courseWizard.step6', $request->input('course_id'));
    }
}
