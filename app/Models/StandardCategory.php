<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandardCategory extends Model
{
    use HasFactory;

    protected $table = "standard_categories";

    protected $primaryKey = 'sc_id';

    protected $fillable = ['sc_name'];
    
    public function courses()
    {
        return $this->hasMany(Course::class, 'sc_id', 'sc_id');
    }

    public function standards() {
        return $this->hasMany(Standard::class, 'sc_id', 'sc_id');
    }
}
