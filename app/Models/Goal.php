<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = ['current_amount'];
    public function charity()
    {
        return $this->belongsTo(Charity::class,'charity_id');
    }
}
