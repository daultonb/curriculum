<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optional_priorities extends Model
{
    use HasFactory;

    protected $primaryKey ='id';

    protected $fillable = [
        'course_id',
        'custom_PLO',
        'input_status',
    ];
}
