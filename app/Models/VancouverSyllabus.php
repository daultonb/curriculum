<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VancouverSyllabus extends Model
{
    use HasFactory;

    protected $table = 'vancouver_syllabi';

    public $timestamps = false;
}
