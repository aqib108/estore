<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'status'
    ];
    public static $roomNumberPrefix='ROOM-NO-';
    // Boot method to register the model event

}
