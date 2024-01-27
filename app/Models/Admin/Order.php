<?php

namespace App\Models\Admin;

use App\Models\Admin\OrderPaymentDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Admin\Product');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
 
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
