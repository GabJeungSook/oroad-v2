<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhilippineRegion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function provinces()
    {
        return $this->hasMany(PhilippineProvince::class, 'region_code', 'region_code');
    }
}
