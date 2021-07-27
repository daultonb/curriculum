<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Program extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $primaryKey = 'program_id';

    protected $table = 'programs';   
    

    protected $fillable = ['program', 'faculty', 'department',  'level', 'status'];

    protected $guarded = ['program_id'];
    
    

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_programs', 'program_id', 'course_id')->withPivot('course_required', 'instructor_assigned', 'map_status')->withTimestamps();
    }

   /* public function mappingScaleLevels()
    {
        return $this->hasManyThrough(MappingScale::Class, MappingScaleProgram::Class);
    }*/

    public function mappingScaleLevels()
    {
        return $this->belongsToMany(MappingScale::class, 'mapping_scale_programs', 'program_id', 'map_scale_id')->withTimestamps();
    }
    
     public function mappingScalePrograms()
    {
        return $this->hasMany(MappingScaleProgram::class, 'program_id', 'program_id');
    }
    
   /* public function newPivot(Model $parent, array $attributes, $table, $exists, $using = NULL) {
        if ($parent instanceof Program) {
            return new MappingScaleProgram($parent, $attributes, $table, $exists, $using = NULL);
        }
        return parent::newPivot($parent, $attributes, $table, $exists, $using = NULL);
    }*/
    
    public function users(){
        return $this->belongsToMany(User::class, 'program_users', 'program_id', 'user_id');
    }

    // Eloquent automatically determines the FK column for the ProgramLearningOutcome model by taking the parent model (program) and suffix it with _id (program_id)
    public function programLearningOutcomes() {
        return $this->hasMany(ProgramLearningOutcome::class, 'program_id', 'program_id');
    }
    
    public function getProgramOCAttribute(){
        $prgID = filter_input(INPUT_SERVER,'PATH_INFO');
        $prgID = explode("/",$prgID)[3];
        $ploCats =  \App\Models\PLOCategory::where('program_id', '=', $prgID)->get()->toArray();
        for($i = 0; $i < count($ploCats); $i++){
            $ploCats[$i]['programOutcome'] = json_encode(\App\Models\ProgramLearningOutcome::
                    where('plo_category_id', '=',$ploCats[$i]['plo_category_id'])
                    ->get()->toArray());
        }
        //this gets the uncategorized records
        $ploCats[count($ploCats)]['programOutcome'] = json_encode(\App\Models\ProgramLearningOutcome::
                    where('plo_category_id', '=',NULL)->where('program_id', '=', $prgID)
                    ->get()->toArray());
        $ploCats[count($ploCats)-1]['plo_category'] = "Uncategorized";
        return json_encode($ploCats);
    }
  
}
