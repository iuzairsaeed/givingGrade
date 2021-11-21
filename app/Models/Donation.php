<?php

namespace App\Models;

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
}
