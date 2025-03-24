<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'address',
        'datetime',
        'status',
        'live_tracking',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    // Relationship to Product
    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
