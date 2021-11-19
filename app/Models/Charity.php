<?php

namespace App\Models;

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
}
