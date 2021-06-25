<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MSOutcomeMap extends Pivot
{
    use HasFactory;

    protected $table = "m_s_outcome_maps";

    protected $primaryKey = ['ministry_standard_id', 'l_outcome_id'];

    public $incrementing = false;
}