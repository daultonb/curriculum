<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingScaleCategory extends Model
{
    use HasFactory;

    protected $table = 'mapping_scale_categories';

    protected $primaryKey = 'mapping_scale_categories_id';

    protected $fillable = ['title', 'description'];

    public function mappingScales() {
        return $this->hasMany(MappingScale::class, 'mapping_scale_categories_id', 'mapping_scale_categories_id');
    }
}
