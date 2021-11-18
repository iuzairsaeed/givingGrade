<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class,'subject_teacher')->withTimestamps();
    }
}
