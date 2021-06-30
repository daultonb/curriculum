<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optional_priorities extends Model
{
    use HasFactory;

    protected $primaryKey ='op_id';
     
    protected $table = 'optional_priorities';

    protected $fillable = [
        //'course_id',
        'optional_priority',
        //'input_status',
    ];
}
