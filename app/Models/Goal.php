<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    public function charity()
    {
        return $this->belongsTo(Charity::class,'charity_id');
    }
}
