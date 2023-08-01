<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'name',
    //     'price',
    //     'weight',
    //     'color',
    // ];

    protected $guarded = [];

    public function carts()
    {
        return $this->belongsTo(Cart::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }

}