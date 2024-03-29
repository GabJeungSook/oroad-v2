<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestPayment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_number', 'request_number');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }
}
