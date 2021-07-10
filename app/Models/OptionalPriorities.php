<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionalPriorities extends Model
{
    use \Backpack\CRUD\app\Models\Traits\HasIdentifiableAttribute;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;


    protected $table = 'optional_priorities';
    protected $primaryKey = 'op_id';
    protected $guarded = ['op_id'];
    protected $fillable = ['op_id','category_title', 'category_desc', 'subcat_name', 'subcat_desc', 'subcat_id','optional_priority'];
    
    public function OptionalPrioritySubcategories(){
        return $this -> belongsTo(OptionalPrioritySubcategories::class, 'subcat_id', 'subcat_id');
    }
    public function CourseOptionalPriorities(){
        return $this -> belongsToMany(CourseOptionalPriorities::class, 'op_id', 'op_id');
    }
}
