<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinistryStandardCategory extends Model
{
    use HasFactory;

    protected $table = "ministry_standard_categories";

    protected $primaryKey = 'msc_id';

    protected $fillable = ['msc_name'];
    
    // CHANGE field program_id when courses table is updated.
    public function courses()
    {
        return $this->hasMany(Course::class, 'msc_id', 'msc_id');
    }

    public function ministryStandards() {
        return $this->hasMany(MinistryStandard::class, 'msc_id', 'msc_id');
    }
}
