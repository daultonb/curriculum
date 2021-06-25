<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinistryStandard extends Model
{
    use HasFactory;

    protected $primaryKey = 'ministry_standard_id';

    protected $fillable = ['ministry_standard_id', 'msc_id', 'ms_shortphrase', 'ms_outcome'];

    public function learningOutcomes(){
        return $this->belongsToMany(LearningOutcome::class)->using(MSOutcomeMap::class); 
    }
}
