<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'stok',
        'price',
        'image'
    ];

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
