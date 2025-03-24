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
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
    
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    
}
