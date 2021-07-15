<?php

namespace App\Models\syllabus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyllabusUser extends Model
{
    use HasFactory;

    protected $table = 'syllabi_users';

    protected $guarded = ['permission'];

    protected $fillable = ['syllabus_id', 'user_id',];

    public $incrementing = false;

}


