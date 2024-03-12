<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function fullName()
    {
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function philippineRegion()
    {
        return $this->belongsTo(PhilippineRegion::class, 'region_code', 'region_code');
    }

    public function philippineProvince()
    {
        return $this->belongsTo(PhilippineProvince::class, 'province_code', 'province_code');
    }

    public function philippineCity()
    {
        return $this->belongsTo(PhilippineCity::class, 'city_code', 'city_municipality_code');
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function representative()
    {
        return $this->hasOne(UserRepresentative::class);
    }
}
