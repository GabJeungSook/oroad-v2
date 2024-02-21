<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function requests()
    {
        return $this->belongsToMany(Request::class)->withPivot(['request_code', 'quantity', 'is_authenticated', 'amount'])->withTimestamps();
    }
}
