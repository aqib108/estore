<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Order()
    {
        return $this->belongsTo('App\Models\Store\Order');
    }
    public function Product()
    {
        return $this->belongsTo('App\Models\Admin\Product');
    }
}
