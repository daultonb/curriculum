<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapping_Scales_Ministry_Standards extends Model
{
    use HasFactory;

    protected $primaryKey = 'map_scale_id';

    // Might Need to relate to courses?
}
