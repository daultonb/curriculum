<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optional_priority_categories extends Model
{
    use HasFactory;

    protected $primaryKey ='cat_id';
    
    protected $table = 'optional_priority_categories';

    protected $fillable = [        
        'cat_name',   
    ];
    public function OptionalPrioritySubcategories(){
        return $this->hasMany(OptionalPrioritySubcategories::class, 'category_id', 'category_id');
    }
}
