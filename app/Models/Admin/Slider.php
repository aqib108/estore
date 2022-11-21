<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $guard = 'admin';
    protected $table = 'sliders';
    protected $fillable = [
        'name', 'image','content', 'status'
    ];
}
