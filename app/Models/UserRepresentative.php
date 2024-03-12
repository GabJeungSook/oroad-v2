<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRepresentative extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function fullName()
    {
        return $this->representative_first_name . ' ' . $this->representative_middle_name . ' ' . $this->representative_last_name;
    }

    public function userInformation()
    {
        return $this->belongsTo(UserInformation::class);
    }
}
