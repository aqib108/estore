<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table='courses';
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'status'
    ];
}
