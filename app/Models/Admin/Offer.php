<?php

namespace App\Models\Admin;

use App\Models\Store\Cart;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $table = 'offers';
    protected $fillable = [
      'title',
      'description',
      'price',
      'status',
      'sku'
  ];
    protected $guarded = [];

    public function offerImages()
    {
        return $this->hasMany(OfferImage::class);
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
