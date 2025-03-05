<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment_screenshots extends Model
{
    protected $fillable = [
        'user_id',
        'screenshots',
        'datetime',
        'status',
    ];
    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

}
