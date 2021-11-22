<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'classroom_subject')->withTimestamps();
    }

    public function teacher()
    {
        return $this->belongsTo(User::class,'user_id')->withTrashed();
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M, y - h:i A');
    }
}
