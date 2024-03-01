<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_information()
    {
        return $this->belongsTo(UserInformation::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class)->withPivot(['request_code', 'quantity', 'is_authenticated', 'amount'])->withTimestamps();
    }

    public function payments()
    {
        return $this->hasOne(RequestPayment::class, 'request_number', 'request_number');
    }

    public function activityTimeline()
    {
        return $this->hasMany(ActivityTimeline::class, 'request_number', 'request_number');
    }
}
