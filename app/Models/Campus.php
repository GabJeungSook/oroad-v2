<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function userInformation()
    {
        return $this->hasMany(UserInformation::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
