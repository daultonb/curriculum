<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ministry_Standard extends Model
{
    use HasFactory;

    protected $primaryKey = 'ministry_standard_id';

    // TO DO: FILL IN USING MINISTRY STANDARDS OUTCOME MAP
    public function learningOutcomes(){
        return $this->belongsToMany('App\Models\LearningOutcome')->using('App\Models\ '); 
    }
}
