<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optional_priorities extends Model
{
    use \Backpack\CRUD\app\Models\Traits\HasIdentifiableAttribute;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;


    protected $table = 'optional_priorities';
    protected $primaryKey = 'op_id';
    protected $guarded = ['op_id'];
    protected $fillable = ['category_title', 'category_desc', 'subcat_title', 'subcat_desc', 'optional_priority'];
    
    public function OptionalPrioritySubcategories(){
        return $this -> belongsTo(OptionalPrioritySubcategories::class, 'subcat_id', 'subcat_id');
    }
    public function CourseOptionalPriorities(){
        return $this -> belongsToMany(CourseOptionalPriorities::class, 'op_id', 'op_id');
    }
}
