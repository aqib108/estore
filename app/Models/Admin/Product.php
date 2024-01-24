<?php

namespace App\Models\Admin;

use App\Models\Store\Cart;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }
}
