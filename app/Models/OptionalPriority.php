<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionalPriority extends Model
{
    use \Backpack\CRUD\app\Models\Traits\HasIdentifiableAttribute;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $table = 'optional_priorities';
    protected $primaryKey = 'op_id';
    protected $guarded = ['op_id'];
    protected $fillable = ['category_title', 'category_desc', 'subcat_title', 'subcat_desc', 'optional_priority'];
    
   public function OptionalPrioritySubcategories(){
       return $this -> belongsTo(OptionalPrioritySubcategories::class, 'subcategory_id', 'subcategory_id');

   }
   public function OptionalPriorityCategories(){
       return $this -> belongsTo(OptionalPriorityCategories::class, 'optional_priority_subcattegories', 'subcategory_id','category_id');
   }
   public function CourseOptionalPriorities(){
       return $this -> belongsToMany(CourseOptionalPriorities::class, 'op_id', 'op_id');
   }
}
