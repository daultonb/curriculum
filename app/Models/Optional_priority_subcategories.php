<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optional_priority_subcategories extends Model
{
    use HasFactory;

    protected $primaryKey ='subcat_id';
    
    protected $table = 'optional_priority_subcategories';

    protected $fillable = [
        'cat_id',
        'subcat_name',
        'subcat_desc',
        //'input_status',
    ];
    public function OptionalPriority(){
        return $this-> hasMany(OptionalPriority::class,'subcategory_id','subcategory_id');
    }
    public function OptionalPriorityCategories(){
        return $this->belongsTo(OptionalPriorityCategories::class, 'category_id','category_id');
    }
}