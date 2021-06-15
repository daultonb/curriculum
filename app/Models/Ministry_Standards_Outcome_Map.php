<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Ministry_Standards_Outcome_Map extends Pivot
{
    use HasFactory;

    protected $primaryKey = ['l_outcome_id','ministry_standard_id'];

    public $incrementing = false;
}
