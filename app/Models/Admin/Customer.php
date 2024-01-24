<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table='customers';
    use HasFactory;
    protected $fillable = [
        'name',
        'mobile_no',
        'nid',
        'address',
        'customer_no',
        'image',
        'status'
    ];
    public static $customerNumberPrefix='CUST-NO-';
}
