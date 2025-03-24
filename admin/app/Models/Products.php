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
       // Relationship to Orders
       public function orders()
       {
           return $this->hasMany(Orders::class, 'product_id');
       }

}
