<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function userInformation()
    {
        return $this->hasMany(UserInformation::class);
    }
}
