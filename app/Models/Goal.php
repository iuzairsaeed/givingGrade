<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = ['current_amount'];
    public function charity()
    {
        return $this->belongsTo(Charity::class,'charity_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M, y - h:i A');
    }
}
