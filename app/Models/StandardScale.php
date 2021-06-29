<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandardScale extends Model
{
    use HasFactory;

    protected $table = 'standard_scales';

    protected $primaryKey = 'standard_scale_id';

    protected $fillable = ['title', 'abbreviation', 'description', 'colour'];

    public function standardsScaleCategory() {
        return $this->belongsTo(StandardsScaleCategory::class, 'ms_scale_category_id', 'ms_scale_category_id');
    }
}
