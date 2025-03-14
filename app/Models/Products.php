<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'image',
        'name',
        'description',
        'amount',
        'offer',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}
