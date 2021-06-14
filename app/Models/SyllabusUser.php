<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyllabusUser extends Model
{
    use HasFactory;

    protected $table = 'syllabi_users';

    protected $primaryKey = ['syllabus_id','user_id'];

    public $incrementing = false;

}


