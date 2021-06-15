<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_Program extends Model
{
    use HasFactory;

    protected $table = 'course_programs';

    protected $primaryKey = ['course_id','program_id'];

    public $incrementing = false;

    // Might Be defined in courses model
    /*
    public function courses() {
        return $this->belongsToMany('App\Models\Course', 'course_programs', 'course_id', 'program_id');
    }
    */
}
