<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = ['id','user_id','charity_id','amount'];

    public function charity()
    {
        return $this->belongsTo(Charity::class,'charity_id');
    }

    public function sponsor()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M, y - h:i A');
    }
}
