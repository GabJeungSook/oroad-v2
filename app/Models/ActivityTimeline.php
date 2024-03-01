<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityTimeline extends Model
{
    use HasFactory;
    public $guarded = [];

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_number', 'request_number');
    }
}
