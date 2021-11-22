<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class,'subject_teacher')->withTimestamps()->withTrashed();
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class,'classroom_subject')->withTimestamps()->withTrashed();
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M, y - h:i A');
    }
}
