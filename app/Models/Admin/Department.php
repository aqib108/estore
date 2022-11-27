<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table='departments';
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'status',
        'file',
        'url'
    ];
}
