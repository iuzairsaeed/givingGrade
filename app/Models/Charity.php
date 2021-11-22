<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    public function teacher()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class,'class_id');
    }

    public function goal()
    {
        return $this->HasOne(Goal::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M, y - h:i A');
    }
}
